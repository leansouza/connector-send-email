<template>
    <div>
        <div class="form-group">
            <label>Email</label>
            <input v-model="email" class="form-control">
            <small class="form-text text-muted">Recipient's email address</small>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input v-model="targetName" class="form-control">
            <small class="form-text text-muted">Recipient's name</small>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input v-model="subject" class="form-control">
            <small class="form-text text-muted">Email subject</small>
        </div>
        <div class="form-group">
            <label>Template</label>
            <select v-model="template" class="form-control">
                <option value=''></option>
                <option value='welcome'>Welcome</option>
            </select>
            <small class="form-text text-muted">Template of the email</small>
        </div>
    </div>
</template>


<script>
    export default {
        props: ["value"],
        data() {
            return {
                email: '',
                targetName: '',
                subject: '',
                template: '',
            };
        },
        watch: {
            email() {
                this.updateConfig()
            },
            targetName() {
                this.updateConfig()
            },
            subject() {
                this.updateConfig()
            },
            template() {
                this.updateConfig()
            },
            value() {
                this.loadConfig();
            },
        },
        computed: {
        },
        methods: {
            loadConfig() {
                const node = this.$parent.$parent.inspectorNode;
                const config = JSON.parse(_.get(node, 'config'));
                this.email = config.email;
                this.targetName = config.targetName;
                this.subject = config.subject;
                this.template = config.template;
            },
            updateConfig() {
                const node = this.$parent.$parent.inspectorNode;
                Vue.set(node, 'config', JSON.stringify({
                    email: this.email,
                    targetName: this.targetName,
                    subject: this.subject,
                    template: this.template,
                }));
            },
        },
        mounted() {
            this.loadConfig();
        }
    };
</script>

<style lang="scss" scoped>
</style>
