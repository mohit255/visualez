<!DOCTYPE html>
<html>
  <head>
    <title>VisualEz Image Rotater</title>
    <link
      rel="stylesheet"
      href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"
    />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>
<style>
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("./assets/loader.gif") center no-repeat;
    }
    /*body{
        text-align: center;
    }*/
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
</style>

  <body class="">
    <div class="col-sm-6 col-sm-offset-3">
      <h1>Processing an Image Rotation</h1>
      <div id="msg"></div>
      <form action="process.php" method="POST">
        <div id="url-group" class="form-group">
          <label for="url">Image Url</label>
          <input
            type="url"
            class="form-control"
            id="url"
            name="url"
            value="https://images.ctfassets.net/hrltx12pl8hq/7yQR5uJhwEkRfjwMFJ7bUK/dc52a0913e8ff8b5c276177890eb0129/offset_comp_772626-opt.jpg"
            placeholder="Image Url"
          />
        </div>

        <div id="degree-group" class="form-group">
          <label for="degree">Degree</label>
          <select 
            class="form-control"
            id="degree"
            name="degree">
            <option selected disabled>--Select Degree--</option>
            <option value="90">90 Degree</option>
            <option value="180">180 Degree</option>
          </select>
        </div>
        <button type="submit" class="btn btn-success">
          Submit
        </button>
      </form>
    </div>
    <div class="overlay"></div>
    <script src="js/form.js"></script>
  </body>
</html>