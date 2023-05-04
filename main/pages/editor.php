<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Bootstrap demo</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>

</head>
<body>
<!-- partial:index.partial.html -->
<!-- <!-- Appears on Tiny Blueprint (https://www.tiny.cloud/blog/) in articles:
 - Enhance Bootstrap forms with WYSIWYG editing-->
<div class="container mt-4 mb-4">
    <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-8">
            <h1 class="h2 mb-4">Submit issue</h1>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Your name">
            </div>

            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email">
              <small class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
              <label>Describe the condition in detail</label>
              <textarea id="editor"></textarea>
            </div>

            <div class="form-group">
                <label for="phone">Primary phone number</label>
                <input type="text" class="form-control" id="phone" placeholder="">
            </div>

            <hr>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terms">
                <label class="form-check-label" for="terms">I agree to the <a href="#">terms and conditions</a></label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
<!-- partial -->
  <script src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/6/tinymce.min.js'></script><script  src="./script.js"></script>

</body>
</html>
