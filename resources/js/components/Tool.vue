<template>
    <div>
        <heading class="mb-6">{{ group }}</heading>

        <div class="flex flex-wrap -mx-3">

            <div class="px-3 mb-6" :class="width" v-for="section in sections" v-if="config.width">
                <loading-card :loading="false" class="px-6 py-4">
                    <h3 class="flex mb-3 text-base text-80 font-bold">
                        {{ section.name }}
                    </h3>

                    <div class="overflow-hidden overflow-x-auto">
                        <ul class="list-reset">
                            <li class="text-sm leading-normal pb-1" v-for="resource in section.resources">
                                <router-link :to="{ name: 'index', params: { resourceName: resource.uriKey }}" class="no-underline text-primary dim">{{ resource.label }}</router-link>
                            </li>
                        </ul>
                    </div>
                </loading-card>
            </div>

        </div>

    </div>
</template>

<script>
export default {

    async created() {
        await this.getToolConfig();
    },

    data:() => ({
        toolConfig: { }
    }),

    methods: {
        getToolConfig() {
            Nova.request().get('/nova-vendor/resource-group-menu')
                .then(({ data }) => {
                    this.toolConfig = data
                })
        }
    },

    computed: {
        width() {
            return 'w-' + this.config.width
        },

        config() {
            return this.toolConfig
        },

        groupSlug() {
            return this.$route.params.group
        },

        group() {
            return _.find(Nova.config.resources, (r) => {
                return r.groupSlug === this.groupSlug
            }).group;
        },

        resources() {
            return _.filter(Nova.config.resources, (r) => {
                return r.groupSlug === this.groupSlug && r.subGroup
            })
        },

        sections() {
            let sections =  _.uniqBy(this.resources, 'subGroupSlug')

            _.forEach(sections, (s) => {
                s.name = s.subGroup
                s.slug = s.subGroupSlug
                s.resources = _.filter(this.resources, (r) => {
                    return r.subGroupSlug === s.slug
                })
            })

            // if (_.isEmpty(sections)) {
            //     let section = { name: this.group }
            //     section.resources = _.filter(this.resources, (r) => {
            //         return r.group === s.name
            //     })
            //     sections = [section]
            // }
            return sections
        },
    }
}
</script>

<style>
/* Scoped Styles */
</style>
