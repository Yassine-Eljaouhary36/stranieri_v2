<div class="accordion" id="faqAccordion">
    @foreach ($activeFaqs as $key => $faq)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{$faq->id}}">
                <button class="accordion-button @if ($key !== 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapse{{$faq->id}}">
                    {{$faq->question}}
                </button>
            </h2>
            <div id="collapse{{$faq->id}}" class="accordion-collapse collapse @if ($key === 0) show @endif" aria-labelledby="heading{{$faq->id}}" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p>
                        {{$faq->answer}}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>