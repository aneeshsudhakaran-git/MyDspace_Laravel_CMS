@pushOnce('scripts')
<script src="{{ asset('/site_asset/js/custom.js') }}" async></script>
@endPushOnce

@push('styles')

@endpush

<x-guest-layout>
    @include('partials.meta', [
        'og_title' => $og_title,
        'og_description' => $og_description,
        'og_image' => $og_image,
        'og_url' => $og_url
    ])

    @forelse ($site_page as $page)
        @if( $page->menutype != 2  && $page->m_link_type == 'S') {{--- check menu is not footer ---}}
        @php
            $sectionClass = $page->classname && isset($Site_Content_Style_Name[$page->classname]) 
                ? $Site_Content_Style_Name[$page->classname] 
                : '';

            $featuredClass = ($page->featured) ? 'featured' : '';
        @endphp

        <section id="{{ $page->menu_name }}" class="{{ $sectionClass }} section {{ $featuredClass }} ">
        {!!  ($page->description) !!} 
        </section>
        @endif
    @empty
            <section id="nodata" class="section">
                <h3 class="container text-center">There are no data.</h3>
            </section>
        
    @endforelse

 

    <x-slot:footer>
        @forelse ($site_page as $page)
            @if( $page->menutype == 2 ) {{--- check menu is footer ---}}
                @php
                    $sectionClass = $page->classname && isset($Site_Content_Style_Name[$page->classname]) 
                        ? $Site_Content_Style_Name[$page->classname] 
                        : '';

                    $featuredClass = ($page->featured) ? 'featured' : '';
                @endphp

                <section id="{{ $page->menu_name }}" class="{{ $sectionClass }} section {{ $featuredClass }} ">
                {!!  ($page->description) !!} 
                </section>
            @endif
        @empty
            <section id="nodata" class="section">
                <h3 class="container text-center">There are no data.</h3>
            </section>

        @endforelse
        
    </x-slot>

</x-guest-layout>
