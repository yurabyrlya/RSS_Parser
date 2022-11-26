<header class="header text-center">
    <a href="/" class="home-link"><span>Go Home</span></a>
    <h3 class="message"><?php echo $message ?></h3>
</header>

<section class="content text-center">
    <div class="table">
            <div class="table-header">
                <div class="header__item"><a id="name" class="filter__link" href="#">Title</a></div>
                <div class="header__item"><a id="desc" class="filter__link filter__link--number" href="#">Description</a></div>
                <div class="header__item"><a id="created-at" class="filter__link filter__link--number" href="#">Created At</a></div>
                <div class="header__item"><a id="author" class="filter__link filter__link--number" href="#">Author</a></div>
            </div>
            <div class="table-content">
                <?php foreach ($data as $key => $item):?>
                    <div class="table-row" data-id="<?php echo 'link-'.$key?>">
                        <div class="table-data">
                            <a id="<?php echo 'link-'.$key?>"
                               class="data-link hide"
                               href="<?php echo $item['link']?>"
                            >View article</a>
                             <?php echo $item['title']?>
                        </div>
                        <div class="table-data"><?php echo $item['description']?></div>
                        <div class="table-data"><?php echo $item['last_build_date']?></div>
                        <div class="table-data"><?php echo $item['copyright']?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
</section>

