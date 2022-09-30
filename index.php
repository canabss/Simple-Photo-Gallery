<?php
    if(isset($_POST['submit'])){
        if(!empty($_FILES['file']['name'])){
            if(file_exists("Photos/".$_FILES['file']['name'])){
                echo "<script>alert('Photo is already exist. Choose another.');</script>";
            }
            else{
                move_uploaded_file($_FILES['file']['tmp_name'], "Photos/".basename($_FILES['file']['name']));
                echo "<script>alert('Photo is successfully uploaded. See in gallery.');</script>";
            }
        }
        else{
            echo "<script>alert('Input file is empty.');</script>";
        }
    }
?>
<html>
    <head>
        <title>Gallery</title>
        <style>
            *{ margin: 0; }
            body{ background: #ddd; }
            .page{ height: 100vh; padding: 5rem 6rem; }
            .nav{ position: fixed; width: 100%; }
            ul { list-style-type: none; margin: 0; padding-left: 20px; overflow: hidden; background-color: #333; }
            li { float: left; font-size: 18px; font-family: 'Monserrat', sans-serif; }
            li a { display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none; }
            h1{ font-size: 50px; font-family: 'Monserrat', sans-serif; font-weight: bold; }
            div.gallery { margin: 5px; border: 1px solid #ccc; float: left; width: 266px; }
            div.gallery:hover { border: 1px solid #777; }
            div.gallery img { width: 100%; height: 180px; }
            .box{ display: flex; align-items: center; justify-content: center; margin-top: 120px;}
            div.description { padding: 15px; text-align: center; background: #fff; }
            form{ width: 400px; background-color: white; padding: 35px; border: 1px solid rgba(0, 0, 0, 0.125); border-radius: 1rem; }
            .file{ font-size: 20px; font-family: 'Monserrat', sans-serif; }
            .save{ height: 40px; width: 100%; color: #fff; background: #333; border: none; cursor: pointer;}
        </style>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li><a href="#file-upload">File Upload</a></li>
                <li><a href="#gallery">Gallery</a></li>
            </ul>
        </div>
        
        <section class="page" id="file-upload">
            <h1>FILE UPLOAD</h1><hr><br><br>
            <div class="box">
                <form method="POST" enctype="multipart/form-data">
                        <input type="file" name="file" accept="image/*" class="file"/><br><br><br>
                    <input type="submit" name="submit" value="Save" class="save"/>
                </form>
            </div>
        </section>
        
        <section class="page" id="gallery">
            <h1>GALLERY</h1><hr><br><br>
            <?php $directory = opendir("Photos/");?>
            <?php while($photo = readdir($directory)):?>
                <?php if($photo!="." && $photo!=".." && $photo!="Thumbs.db"):?>
                    <div class="gallery">
                        <a target="_blank" href= <?php echo "Photos/".$photo;?>>
                            <img src=<?php echo "Photos/".$photo;?> alt="Cinque Terre">
                        </a>
                        <div class="description"><?php echo $photo;?></div>
                    </div>
                <?php endif;?>
            <?php endwhile;?>
        </section>
    </body>
</html>