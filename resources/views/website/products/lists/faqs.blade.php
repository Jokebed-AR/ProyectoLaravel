@if($contentPage->questions != null)
    <?php $questions = json_decode($contentPage->questions)?>
    @if(!is_string($questions))
        @if(count($questions) > 0)
            <div class="w-full flex flex-col justify-start fadeIn md:space-x-5 bg-gray-600 p-8">
                <div class="mb-4 px-4">
                    @if($contentPage->faq_title != null && $contentPage->faq_title != '')
                        <h3 class="text-2xl text-center uppercase font-extrabold">{{$contentPage->faq_title}}</h3>
                    @else
                        <h3 class="text-2xl text-center uppercase font-extrabold">Preguntas Frecuentes</h3>
                    @endif
                </div>
                <div class="flex flex-col md:flex-row md:flex-wrap fadeIn justify-center">
                    <div class="flex flex-col w-full lg:w-3/4 space-y-6 mt-8">
                        <accordion-component>
                            @foreach ($questions as $question)
                                <accordion-item-component>
                                    <!-- This slot will handle the title/header of the accordion and is the part you click on -->
                                    <template slot="accordion-trigger">
                                    <span class="text-xl text-secondary-100">
                                        {{$question->question}}
                                    </span>
                                        <div class="w-1/4 flex justify-end">
                                        <span>
                                            <svg viewBox="0 0 330 330" width="20px" height="20px" fill="#225d38">
                                                <path id="XMLID_225_"
                                                      d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393  c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393  s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"/>
                                            </svg>
                                        </span>
                                        </div>
                                    </template>
                                    <!-- This slot will handle all the content that is passed to the accordion -->
                                    <template slot="accordion-content">
                                        <p class=" mt-4"> {{$question->answer}}
                                        </p>
                                    </template>
                                </accordion-item-component>
                            @endforeach
                        </accordion-component>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endif
