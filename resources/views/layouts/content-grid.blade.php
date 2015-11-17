<div class="container-fluid content">
    <div class="row">

        @foreach(range(1,6) as $n)
            <div class="medium-4 column">
                <div class="card">
                    <section class="head">
                        <img src="{{ asset('dreamsark-assets/card.png') }}" alt="">
                    </section>

                    <section class="content">

                        <div class="title">
                            The Super Man Origen
                        </div>

                        <div class="description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet,
                            consectetur adipisicing elit. Facere.
                        </div>

                        <button class="button primary">View Project</button>

                    </section>
                </div>
            </div>
        @endforeach


    </div>

</div>