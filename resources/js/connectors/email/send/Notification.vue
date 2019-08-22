<template>
 <div class="p-0 notification">

    <div class="notification-settings-group p-3">
        <div class="custom-control custom-switch m-2">
            <input v-model="config.email_notifications.enableNotifications" type="checkbox" class="custom-control-input" id="email-notification">
            <label class="custom-control-label" for="email-notification">{{ $t('Email Notifications') }}</label>
        </div>
    </div>
    <div v-show="config.email_notifications.enableNotifications" class="p-0 h-100 overflow-auto">
        
        <button v-b-toggle.configuration
                  variant="outline"
                  class="accordion-button text-left card-header d-flex align-items-center w-100 border-right-0 border-left-0 border-top-0"
                  @click="showConfiguration = !showConfiguration"
        >
            <i class="fas fa-paper-plane mr-2"/> 
            {{ $t('Notifications' ) }}
            <i class="fas fa-angle-down ml-auto"
            :class="{ 'fas fa-angle-right' : showConfiguration }">
            </i>
        </button>

        <b-collapse id="configuration" class="px-3 py-2" visible>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="m-0">{{ $t('Notifications') }}</h6>
                <b-button v-b-toggle.email-configuration 
                          variant="link" 
                          class="p-0 text-secondary" 
                >
                    <i class="fas fa-plus-square"></i>
                </b-button>
            </div>
            <b-collapse id="email-configuration">
                <b-card no-body :header="$t('Add Notification')">
                    <form @submit.prevent="onSubmit()">
                        
                        <email-options @usersGroupsSelected="setUsersAndGroups" v-model="initNotification" :default-subject="initNotification.subject" :node="node()" ></email-options>     
                        
                        <div class="form-group px-4 py-3 m-0 border-bottom">
                            <label>{{ $t('Send At') }}</label>
                            <select class="form-control" v-model="initNotification.sendAt">
                                <option value="task-start">{{ $t('Task Start') }}</option>
                                <option value="task-end">{{ $t('Task Completion') }}</option>
                            </select>
                            <small class="form-text text-muted">{{ $t('Choose when this email will be sent to recipients') }}</small>
                        </div>

                        <div class="form-group px-4 py-3 m-0 border-bottom">
                            <label>{{ $t('Expression') }}</label>
                            <input :placeholder="$t('varname == true')" class="form-control" v-model="initNotification.expression">
                            <small class="form-text text-muted">{{ $t('This notification will only be sent if the expression is true.') }}</small>
                        </div>

                        <b-card-footer class="text-right">
                            <b-button size="sm" variant="outline-secondary" @click="onCancel" >{{ $t('Cancel') }}</b-button>
                            <b-button type="submit" size="sm" variant="secondary" >{{ $t('Save') }}</b-button>
                        </b-card-footer>

                    </form>
                </b-card>
            </b-collapse>
         
            <b-card no-body v-show="showDeleteNotification" 
                    bg-variant="danger"
                    text-variant="white"
            >
                <div class="p-3">{{ $t('Are you sure you want to delete "') + this.deleteNotification.notification.subject  + $t('" notifications?')}}</div>
                <b-card-footer class="text-right">
                    <b-button size="sm" variant="light" @click="showDeleteNotification = !showDeleteNotification">{{ $t('Cancel')  }}</b-button>
                    <b-button size="sm" variant="link text-white" @click="onDelete()">{{ $t('Delete') }}</b-button>
                </b-card-footer>
            </b-card>
           
             <table class="table table-sm table-striped">
                 <tbody>
                     <tr v-for="(notification, index) in config.email_notifications.notifications">
                         <td>
                             <i class="far fa-envelope"></i> {{ notification.subject}} 
                         </td>
                         <td class="text-right actions">
                             <b-button variant="link" class="p-0 text-secondary" :title="$t('edit')" @click="onEdit(notification, index)"><i class="fas fa-cog"></i></b-button>
                             <b-button variant="link" class="p-0 text-secondary" :title="$t('duplicate')" @click="onDuplicate(notification)"><i class="far fa-copy"></i></b-button>
                             <b-button variant="link" class="p-0 text-secondary" :title="$t('delete')" @click="onConfirmDelete(notification, index)" ><i class="fas fa-trash-alt"></i></b-button>
                         </td>
                     </tr>
                 </tbody>
             </table>
        </b-collapse>

        
    </div>
 </div>
</template>

<script>
import EmailOptions from "./EmailOptions";

export default {
    components: {
        EmailOptions
    },
    props: {
        value: {
        type: Array,
        default: () => []
      }
    },
    data() {
        return {
            showConfiguration: false,
            showDeleteNotification: false,
            confirmDelete: false,
            defaultSubject: '',
            config: {
                email_notifications: {
                    enableNotifications: false,
                    notifications: [],
                },
            },
            initNotification: {
                sendAt:'task-start',
                expression: '',
                subject: ''
            },
            editNotificationIndex: null,
            deleteNotification: {
                index: null,
                notification: {}
            },
        }
    },
    watch: {
        "$parent.$parent.$parent.$parent.highlightedNode.definition.name" : {
            handler(value) {
                this.initNotification.subject = 'RE: ' + value; 
                // console.log(value, 'handler')
                // console.log(this.initNotification.subject, 'subject');
                // this.config.email_notifications.notifications.push(Object.assign({},this.initNotification));
            }
        },
        "config.email_notifications": {
            deep: true,
            handler() {
                this.setNodeConfig();
            }
        },
    },
    methods: {
        node() { 
            return this.$parent.$parent.$parent.$parent.highlightedNode.definition;
        }, 
        setNodeConfig() {
            Vue.set(this.node(), 'config', JSON.stringify(this.config));
        },
        onSubmit() {
            if (this.editNotificationIndex == null) {
                this.config.email_notifications.notifications.push(Object.assign({},this.initNotification));
            }
            this.clearForm();
            this.$root.$emit('bv::toggle::collapse', 'email-configuration');
        },
        setUsersAndGroups(event) {
            Vue.set(this.node(), 'usersGroupsSelected',  JSON.stringify(event));
        },
        getNodeConfig() {
            if (_.get(this.node(), 'config')) {
                this.config = JSON.parse(_.get(this.node(), 'config'));
            } 
            let nodeName = _.get(this.node(), 'name');
            this.initNotification.subject = 'RE: ' + nodeName;
        },
        onEdit(notification, index) {
            this.initNotification = notification;
            this.editNotificationIndex = index;
            this.$root.$emit('bv::toggle::collapse', 'email-configuration');
        },
        onDuplicate(notification) {
            this.config.email_notifications.notifications.push(Object.assign({}, notification));
        },
        onConfirmDelete(notification, index) {
            this.showDeleteNotification = true;
            this.deleteNotification =  {
                index: index,
                notification: notification
            }
        },
        onDelete() {
            this.config.email_notifications.notifications.splice(this.deleteNotification.index, 1);
            this.showDeleteNotification = !this.showDeleteNotification;
            this.deleteNotification = {
                index: null,
                notification: {}
            };
        },
        onCancel() {
            this.$root.$emit('bv::toggle::collapse', 'email-configuration');
        },
        clearForm() {
            this.editNotificationIndex = null;
            this.initNotification = {
                emailOptionsConfig: {
                    sendAt:'task-start',
                    expression: '',
                }
            };
        }
    },
    mounted() {
        this.getNodeConfig();
        this.$root.$on('bv::collapse::state', (collapseId, isJustShown) => {
            if (collapseId === 'email-configuration' && !isJustShown) {
                this.clearForm();
            }
        });
    }
}
</script>

<style scoped>
.notification {
    padding: 0!important;
}

.table td.actions {
    white-space: nowrap;
}
</style>
