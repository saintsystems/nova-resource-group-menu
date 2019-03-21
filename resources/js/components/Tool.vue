<template>
    <div>
        <heading class="mb-6">{{ group }}</heading>

        <div class="flex flex-wrap -mx-3">

            <div class="px-3 mb-6 w-1/4" v-for="section in sections">
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

    data:() => ({
    }),

    computed: {
        group() {
            return this.$route.params.group
        },

        resources() {
            return _.filter(Nova.config.resources, (r) => {
                return r.group === this.group && r.subGroup
            })
        },

        sections() {
            let sections =  _.uniqBy(this.resources, 'subGroup')

            _.forEach(sections, (s) => {
                s.name = s.subGroup
                s.resources = _.filter(this.resources, (r) => {
                    return r.subGroup === s.name
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
