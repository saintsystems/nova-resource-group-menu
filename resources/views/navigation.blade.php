@php
    $resources = collect(Nova::availableResources(request()));
    $navigation = $resources->filter(function($resource, $key) {
        return isset($resource::$subGroup);
    })->groupBy(function ($item, $key) {
        return $item::group();
    })->sortKeys()->all();

    $resourceGroupMenu = collect(Nova::availableTools(request()))->first(function($tool) {
        return $tool instanceof SaintSystems\Nova\ResourceGroupMenu\ResourceGroupMenu;
    });
@endphp
@if (count($navigation))
    @foreach ($navigation as $group => $resources)
    <router-link tag="a" :to="{ name: 'resource-group-menu', params: { 'group': '{{ \Illuminate\Support\Str::slug($group) }}' }}" class="cursor-pointer flex items-center font-normal dim text-white mb-6 text-base no-underline">
        {{-- <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="var(--sidebar-icon)" d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z"/></svg> --}}

            {{-- <svg class="sidebar-icon" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="icon-shape">
                    <path fill="var(--sidebar-icon)" d="M10,1 L20,7 L10,13 L0,7 L10,1 Z M16.6666667,11 L20,13 L10,19 L0,13 L3.33333333,11 L10,15 L16.6666667,11 Z" id="Combined-Shape"></path>
                </g>
            </g>
            </svg> --}}
            {!! $resourceGroupMenu->getGroupIcon(\Illuminate\Support\Str::slug($group)) !!}
            <span class="sidebar-label">
                {{ __($group) }}
            </span>

    </router-link>
    @endforeach
@endif

