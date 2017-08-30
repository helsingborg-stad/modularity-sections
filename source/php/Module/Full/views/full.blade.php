<section id="{{ $sectionID }}" class="section section-full background-4 {{ $classes }}" style="background-color: {{ $backgroundColor }}; background-image: url({{ $backgroundImage }}); ">
   <div class="container">
      <div class="grid">
         <div class="grid-xs-12">
            <article class="section-article">
               <div class="grid content-grid">
                  <div class="section-text grid-xs-12">
                     @if (!$hideTitle && !empty($post_title))
                     <h2 class="section-title">{!! apply_filters('the_title', $post_title) !!}</h2>
                     @endif
                     <div class="column-enabler">
                        {!! $content !!}
                     </div>
                  </div>
               </div>
            </article>
         </div>
      </div>

      @if(is_array($submodules) && !empty($submodules))
          <div class="grid section-submodules">
             <div class="grid-xs-12">
                {!! $submoduleRendered !!}
             </div>
          </div>
       @endif
   </div>
</section>
