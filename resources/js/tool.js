import ResourceGroupMenu from './components/Tool'

Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'resource-group-menu',
            path: '/resource-group-menu/:group',
            component: ResourceGroupMenu,
        },
    ])
})
