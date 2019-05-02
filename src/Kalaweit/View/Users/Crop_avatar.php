<?php namespace Kalaweit\View\Users;


class Crop_avatar
{

    function render(){

        require_once( __DIR__ .'/../head.php');

        ?>

        <div class="content">
            <div class="container-fluid" style="padding-left:0px;">
                <div class="row">

                    <div class="col-md-12">

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Mise à jour de l'Avatar</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">

                                <div class="col-md-12">

                                    <div id="image_demo" class=""></div>

                                </div>`
                                <div class="">
                                    <label for="upload_image" class="btn btn-default ">Choisir un fichier</label>

                                    <input id="upload_image" type="file" name="upload_image"style="display:none;">

                                    <button  id="updload_cropped_image"class="btn btn-primary pull-right "> Enregistrer l'avatar </button>
                                </div>

                            </div>
                        </div>

                    </div>





                    <?php

                    require_once( __DIR__ .'/../footer.php');

                    ?>

                    <script src="/../node_modules/Croppie-2.6-2.4/croppie.js"></script>

                    <script>

                    $(document).ready(function(){

                        $image_crop = $('#image_demo').croppie({
                            enableExif:true,
                            viewport:{
                                width:200,
                                height: 200,
                                type:'circle'
                            },
                            boundary:{
                                width:300,
                                height:300
                            }
                        });

                    });

                    $('#upload_image').on('change', function(){
                        var reader = new FileReader();
                        reader.onload = function(event){
                            $image_crop.croppie('bind',{
                                url:event.target.result
                            }).then(function(){
                                console.log('jQuery bind complete');
                            });
                        }
                        reader.readAsDataURL(this.files[0]);

                    });

                    var user_id = window.location.search;

                    console.log(user_id);


                    $('#updload_cropped_image').click(function(event){

                        $image_crop.croppie('result',{
                            type:'base64',
                            size: 'viewport'
                        }).then(function(response){
                            $.ajax({

                                url: '/www/Kalaweit/Ajax_get/upload_avatar'+user_id,
                                method:'POST',
                                data:{
                                    "image": response,
                                },
                                success:function(data)
                                {
                                     window.location.href = "http://localhost:8888/www/Kalaweit/users/update"+user_id;
                                }

                            });
                        })
                    });


                    </script>

                <?php         }
            }
