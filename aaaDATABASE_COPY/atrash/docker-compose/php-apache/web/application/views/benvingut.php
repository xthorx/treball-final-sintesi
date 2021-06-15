<?php if($this->session->flashdata('message') != NULL){ ?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="position:absolute; top: 10px; left:0; right:0; margin-left: auto; margin-right: auto; max-width: 500px;">
        <?php echo $this->session->flashdata('message') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


<div class="container text-center">
    <h2><?php echo $title; ?></h2>
    <p><?php echo $subtitle; ?></p>
    
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" data-interval="5000">
                <img src="<?php echo base_url("assets/img/classe_alumnes.jpg")?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h4 class="text-white font-weight-bolder" style="text-shadow: 0 0 2px #000000;">Especialment pensat pels alumnes</h4>
                <p style="text-shadow: 0 0 2px #000000;">El nostre gestor de recursos i elements d'aprenentatge està dissenyat<br>per garantitzar un millor aprenentatge de l'alumne.</p>
                </div>
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="<?php echo base_url("assets/img/classe_online_nen.jpg")?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h4 class="text-white font-weight-bolder" style="text-shadow: 0 0 2px #000000;">Les teves assignatures, siguis on siguis</h4>
                <p style="text-shadow: 0 0 2px #000000;">Accedeix als contiguts de les teves assignatures preferides<br>des de qualsevol lloc amb connexió a internet.</p>
                </div>
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="<?php echo base_url("assets/img/classes_especifiques.jpg")?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h4 class="text-white font-weight-bolder" style="text-shadow: 0 0 2px #000000;">Gestor de continguts de tot tipus</h4>
                <p style="text-shadow: 0 0 2px #000000;">Pensat per tot tipus de continguts, amb funcionalitats que<br>t'ajudaran per qualsevol material específic.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>




</div>

<div class="bg-light text-center mt-3 p-4">
    <div class="mx-auto d-inline-block text-left mb-3">
        <h2>Navega per les categories</h2>
        <?php echo $categoriesList ?>
    </div>
</div>
