<body>
    @include('header')
    <div>
        <?php
        if(isset($domain))
        {
            echo "Домен ".$domain." по ключевому слову ".$key." находится на ".$position." Позиции";
        }
        ?>
    </div>
    <div id="searchform" class="row col-6">
        <div class="col-12">
            <form method="post" action="/gsearch" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row col-12">
                    <p>
                        Enter the Domain name and key word
                    </p>
                </div>
                <div class="row ">
                    <div class="col-3">
                        <label for="domain">Domain Name</label>
                        <input name="domain" type="text" id="domain">
                    </div>
                    <div class="col-3">
                        <label for="key">Key word</label>
                        <input name="key" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
