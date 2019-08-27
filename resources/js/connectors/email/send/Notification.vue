<template>
 <div class="p-0 notification">

    <div class="p-0 h-100 overflow-auto">

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
                <b-button @click="addNotification()"
                          variant="link"
                          class="p-0 text-secondary"
                >
                    <i class="fas fa-plus-square"></i>
                </b-button>
            </div>
            <b-collapse id="email-configuration" v-model="showConfig">
                <b-card no-body :header="$t('Add Notification')">
                    <email-options v-model="initNotification" :node="node()" ></email-options>

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
                        <b-button type="submit" size="sm" variant="secondary" @click="closeForm">{{ $t('Close') }}</b-button>
                    </b-card-footer>
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
                     <tr v-for="(notification, index) in config.email_notifications.notifications" :key="index">
                         <td>
                             <i class="far fa-envelope"></i> {{ notification.subject}}
                         </td>
                         <td class="text-right actions">
                             <b-button variant="link" class="p-0 text-secondary" :title="$t('edit')" @click="onEdit(notification, index)"><i class="fas fa-cog"></i></b-button>
                             <b-button variant="link" class="p-0 text-secondary" :title="$t('duplicate')" @click="onDuplicate(notification)"><i class="far fa-copy"></i></b-button>
                             <b-button variant="link" class="p-0 text-secondary" :title="$t('delete')" @click="onConfirmDelete(notification, index)" ><i class="fas fa-trash-alt"></i></b-button> </td>
                     </tr>
                 </tbody>
             </table>
        </b-collapse>


    </div>
 </div>
</template>

<script>
import EmailOptions from "./EmailOptions";
import helper from '../../../helper';

export default {
    components: {
        EmailOptions
    },
    mixins: [helper],
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
            newNotificationIndex: null,
            config: {
                email_notifications: {
                    notifications: [],
                },
            },
            initNotification: {
                sendAt: this.$t('task-end'),
                expression: '',
                subject: '',
                type: 'text',
                textBody: '',
                addEmails: [],
                users: [],
                groups: [],
                screenRef: null,
            },
            editNotificationIndex: null,
            deleteNotification: {
                index: null,
                notification: {}
            },
            showConfig: false,
        }
    },
    watch: {
        "highlightedNode.definition.name" : {
            handler(value) {
                if (this.initNotification !== '') {
                    this.initNotification.subject = this.$t('RE') + ': ' + value;
                    this.initNotification.textBody = this.$t('You have a pending task') + ': ' + value;
                }
            }
        },
        "initNotification": {
            deep: true,
            handler() {
                this.setNodeConfig();
            }
        },
        config: {
            deep: true,
            handler() {
                this.setNodeConfig();
            }
        },
    },
    methods: {
        node() {
            return this.highlightedNode.definition;
        },
        addNotification() {
            this.config.email_notifications.notifications.push(Object.assign({}, this.initNotification));
            this.createdNotificationIndex = this.config.email_notifications.notifications.findIndex(x => x.subject === this.initNotification.subject);
        },
        getNodeConfig() {
            if (_.get(this.node(), 'config')) {
                this.config = JSON.parse(_.get(this.node(), 'config'));
            }
        },
        setNodeConfig() {
            if (this.newNotificationIndex !== null) {
                this.updateNodeConfig(this.newNotificationIndex);
            } 
            
            if (this.editNotificationIndex !== null) {
                this.updateNodeConfig(this.editNotificationIndex);
            }
            Vue.set(this.node(), 'config', JSON.stringify(this.config));
        },
        updateNodeConfig(index) {
            let notification = this.config.email_notifications.notifications[index];
            Object.assign(notification, this.initNotification);
        },
        setUsersAndGroups(event) {
            Vue.set(this.node(), 'usersGroupsSelected',  JSON.stringify(event));
        },
        onEdit(notification, index) {
            if (this.showConfig) {
                // Just close the open one
                this.showConfig = false;
                return;
            }
            this._beforeEditingCache = _.cloneDeep(notification);
            this.initNotification = notification;
            this.editNotificationIndex = index;
            this.showConfig = true
        },
        onDuplicate(notification) {
            let duplicateNoticiation = _.cloneDeep(notification);
            duplicateNoticiation.subject = duplicateNoticiation.subject + this.$t(' copy');
            this.config.email_notifications.notifications.push(Object.assign({}, duplicateNoticiation));
        },
        onConfirmDelete(notification, index) {
            this.showDeleteNotification = true;
            this.deleteNotification =  {
                index: index,
                notification: notification
            }
        },
        onDelete() {
            this.$delete(this.config.email_notifications.notifications, this.deleteNotification.index);
            this.showDeleteNotification = !this.showDeleteNotification;
            this.deleteNotification = {
                index: null,
                notification: {}
            };
        },
        onCancel() {
            if (this.editNotificationIndex !== null) {
                this.initNotification = _.cloneDeep(this._beforeEditingCache)
            } else {
                this.$delete(this.config.email_notifications.notifications, this.deleteNotification.index);
            }
            this.showConfig = false
        },
        closeForm() {
            this.showConfig = false
        },
    },
    mounted() {
        this.getNodeConfig();
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
