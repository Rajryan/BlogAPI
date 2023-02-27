<?php if(!defined('SECURE')) exit('<h1>Access Denied</h1>');
global $user;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
<?php 
require 'components/nav.php';
require_once 'blog/forms.php';
if($user->id==null){
  redirect(reverse('login'));
}

$form = new BlogForm();
if($_SERVER['REQUEST_METHOD']=="POST"){
  $form->fill_form($_POST);
  if(count($form->get_errors())==0){
    $data = cleaned_data($_POST);
    $data['author']= $user->id;
    $id = db_insert('Blog',data:$data);
    if($id){
      redirect(reverse('blog_detail', arguments:array($id)));
    }
  }
}
?>

<!-- Container -->
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <form action="" method="post" accept-charset="utf-8">
        <?php echo $form->render_form();?>
         <button class="mt-4 px-3 btn btn-primary ml-auto">Save</button>
      </form>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>