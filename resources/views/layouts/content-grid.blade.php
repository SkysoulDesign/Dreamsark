<div class="row">

    @foreach(range(1,6) as $n)
        <div class="medium-4 column">
            <div class="card">
                <section class="head">
                    <img src="{{ asset('dreamsark-assets/card.png') }}" alt="">
                </section>

                <section class="body">

                    <div class="title">
                        The Super Man Origen
                    </div>

                    <div class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Facere.
                    </div>

                    <button class="primary short">View Project</button>

                </section>

            </div>
        </div>
    @endforeach

    <div class="medium-12 column">
        <section class="segment centered transparent marged padded">
            <button class="primary medium round right-arrow">Load More</button>
        </section>
    </div>

</div>

