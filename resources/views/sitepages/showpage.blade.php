@pushOnce('scripts')
    <script src="{{ asset('/site_asset/js/custom.js') }}"></script>
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

    @forelse ($sitepages as $page)

        @php
            $sectionClass = $page->classname && isset($Site_Content_Style_Name[$page->classname]) 
                ? $Site_Content_Style_Name[$page->classname] 
                : '';

            $featuredClass = ($page->featured) ? 'featured' : '';
        @endphp

        <section id="{{ $page->m_name }}" class="{{ $sectionClass }} section {{ $featuredClass }} ">
        {!!  ($page->description) !!} 
        </section>
 
        @empty
            <section id="nodata" class="section">
                <h3 class="container text-center">There are no data.</h3>
            </section>
            
    @endforelse


    <x-slot:footer>
        @forelse ($footer_sitepages as $f_page)
            @if( $f_page->m_menutype == 2 ) {{--- check menu is footer ---}}
                @php
                    $sectionClass = $f_page->classname && isset($Site_Content_Style_Name[$f_page->classname]) 
                        ? $Site_Content_Style_Name[$f_page->classname] 
                        : '';

                    $featuredClass = ($f_page->featured) ? 'featured' : '';
                @endphp

                <section id="{{ $f_page->m_name }}" class="{{ $sectionClass }} section {{ $featuredClass }} ">
                {!!  ($f_page->description) !!} 
                </section>
            @endif
        @empty
            <section id="nodata" class="section"></section>

        @endforelse
    </x-slot>

</x-guest-layout>
