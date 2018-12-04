<template>
    <div>
        <div class="form-group">
            <label>Email</label>
            <input v-model="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Name</label>
            <input v-model="targetName" class="form-control">
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input v-model="subject" class="form-control">
        </div>
    </div>
</template>


<script>
    export default {
        props: ["value", "label", "helper", "property"],
        data() {
            return {
                email: '',
                targetName: '',
                subject: '',
            };
        },
        watch: {
            email() {this.updateConfig()},
            targetName() {this.updateConfig()},
            subject() {this.updateConfig()},
            value() {
                const node = this.$parent.$parent.inspectorNode;
                const config = JSON.parse(_.get(node, 'config'));
                this.email = config.email;
                this.targetName = config.targetName;
                this.subject = config.subject;
            },
        },
        computed: {
        },
        methods: {
            updateConfig() {
                const node = this.$parent.$parent.inspectorNode;
                Vue.set(node, 'config', JSON.stringify({
                    email: this.email,
                    targetName: this.targetName,
                    subject: this.subject,
                }));
            },
        },
    };
</script>

<style lang="scss" scoped>
</style>
