<div clasS="container">

    <p class="border p-3 d-inline-block">Categoria: <a href="<?php echo base_url("categoria/" . $inforecurs->categoria); ?>"><?php echo $categoriarecurs; ?></a></p>

    <h1 class="border bg-light p-3 rounded"><?php echo $inforecurs->titol; ?></h1>


    <div class="border bg-light p-3 rounded"><?php echo htmlspecialchars_decode($inforecurs->descripcio); ?></div>


    <?php if($inforecurs->tipus_recurs=="infografia"){ ?>

        <img src="<?php echo base_url("uploads/recurs_" . $inforecurs->id . "/" . $inforecurs->arxiu_name) ?>" class="img-fluid mt-2" alt="Infografia">

    <?php }else if($inforecurs->tipus_recurs=="video_arxiu"){ ?>

        <video src="<?php echo base_url("uploads/recurs_" . $inforecurs->id . "/" . $inforecurs->arxiu_name) ?>" class="img-fluid mt-2" controls></video>

    <?php }else if($inforecurs->tipus_recurs=="pissarra"){ ?>

        <img src="<?php echo base_url("uploads/recurs_" . $inforecurs->id . "/" . $inforecurs->arxiu_name) ?>" class="img-fluid mt-2" alt="Infografia">

    <?php }else if($inforecurs->tipus_recurs=="video_youtube"){ ?>

        <div id="reproductorYT"></div>




        <script>
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('reproductorYT', {
            height: '390',
            width: '640',
            videoId: '<?php echo $inforecurs->video_youtube; ?>',
            playerVars: {
                'playsinline': 1
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
            });
        }

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
            setTimeout(stopVideo, 6000);
            done = true;
            }
        }
        function stopVideo() {
            player.stopVideo();
        }
        </script>



    <?php } ?>



    

    <?php if($visitesrecurs != null){ ?>
    <div class="border bg-light p-3 rounded mt-3">Visites al recurs: <?php echo $visitesrecurs ?></div>
    <?php } ?>


    
    <?php if($arxiusadjunts_permis=="si"){?>

        <div class="border bg-light p-3 rounded mt-3">
            <p>Arxius adjunts:</p>
            <?php if($arxiusadjunts != null){foreach($arxiusadjunts as $arxiu){
                echo "<a href='../../uploads/recurs_$inforecurs->id/fitxers/$arxiu' download>$arxiu</a>";?>
                <button onclick="borrarArxiu('<?php echo $arxiu; ?>')" class="btn btn-danger btn-sm rounded-circle">x</button><br>
            <?php }}else{echo "-Sense fitxers adjunts-";}?><br>
            
            <p class="mb-2">Penjar un nou fitxer:</p>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="fitxerAdjuntAfegir">
                <button type="submit">Enviar</button>
            </form>
        </div>


        <script>
            function borrarArxiu(arxiu){
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url("recursos/mostrar/" . $inforecurs->id) ?>',
                    data: { 
                        'arxiuadjunt': arxiu
                    },
                    success: function(msg){
                        location.reload();
                    }
                });
            }
            
        </script>

    <?php }else { ?>


        <div class="border bg-light p-3 rounded mt-3">
            <p>Arxius adjunts:</p>
            <?php if($arxiusadjunts != null){foreach($arxiusadjunts as $arxiu){
                echo "<a href='../../uploads/recurs_$inforecurs->id/fitxers/$arxiu' download>$arxiu</a><br>";?>
            <?php }}else{echo "-Sense fitxers adjunts-";}?>
        </div>


    <?php }?>


    



    <div class="border bg-light p-3 rounded mt-3">
        <p class="m-0 p-0 d-inline-block">Tags:</p>
        
        <?php foreach($tagsrecurs as $tag){ ?>

            <p class="m-2 p-2 d-inline-block border rounded"><?php echo $tag->tag; ?></p>

        <?php } ?>

    </div>


</div>