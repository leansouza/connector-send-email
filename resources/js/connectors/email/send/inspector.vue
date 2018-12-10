<template>
    <div>
        <div class="form-group">
            <label>Email</label>
            <input v-model="config.email" class="form-control">
            <small class="form-text text-muted">Recipient's email address</small>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input v-model="config.targetName" class="form-control">
            <small class="form-text text-muted">Recipient's name</small>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input v-model="config.subject" class="form-control">
            <small class="form-text text-muted">Email subject</small>
        </div>
        <modeler-screen-select label="Screen For Input"
                               helper='What Screen Should Be Used For Sending This Email'
                               types='EMAIL'
                               :params='{type:"DISPLAY"}'
                               v-model='config.screenRef'
                               ></modeler-screen-select>
    </div>
</template>


<script>
    export default {
        props: ["value"],
        data() {
            return {
                config: {
                    email: '',
                    targetName: '',
                    subject: '',
                    screenRef: '',
                },
            };
        },
        watch: {
            config: {
                deep: true,
                handler() {
                    this.updateConfig();
                }
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
                Object.keys(config).forEach(key => {
                    Vue.set(this.config, key, config[key]);
                });
            },
            updateConfig() {
                const node = this.$parent.$parent.inspectorNode;
                Vue.set(node, 'config', JSON.stringify(this.config));
            },
        },
        mounted() {
            this.loadConfig();
        }
    };
</script>

<style lang="scss" scoped>
</style>
