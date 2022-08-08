<?php 
$title = "contact";
$error = null;
$succes = false;
require_once 'class/GuestBook.php';
require_once 'class/Message.php';
$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
if(isset($_POST['username'], $_POST['message'])){
   $message = new Message($_POST['username'], $_POST['message']);
   if($message->isValid()){
      $guestbook->addMessage($message);
      $succes = true;
      $_POST=[];

   }else{

      // $error = " Your username is invalid";
      $error = $message->getErrors();

   }
}
$messages = $guestbook->getMessages();


require_once 'elements/header.php';

 ?>
 
<div class = "row"></div>
<div class = "col-md-8">
<?php if(!empty($error)) :?>
   <div class ="alert alert-danger">
      Invalid Form!!!
   </div>
<?php endif; ?>  
<?php if($succes) :?>
   <div class ="alert alert-success">
      Merci pour votre message !
   </div>
<?php endif; ?>    
    <h1 class =" text-center"> Livre D'or</h1>
 <form action="" method="POST">
   
    <div class = "form-group">
        <input type = "text" value="<?=htmlentities($_POST['username'] ?? '' )?>" class = "form-control <?= isset($error['username']) ? 'is-invalid' : '' ?>" placeholder = "Enter your name " name = "username">
        <?php if(isset($error['username'])):?>
         <div class = "invalid-feedback">
            <?= $error['username']?>
         </div>
         <?php endif;?>
     </div>
     <div class = "form-group">
        <textarea type = "text" class = "form-control <?= isset($error['message']) ? 'is-invalid' : '' ?>" placeholder = " Enter your message " name = "message"><?=htmlentities($_POST['message'] ?? '' )?></textarea>
        <?php if(isset($error['message'])):?>
         <div class = "invalid-feedback">
            <?=$error['message']?>
         </div>
         <?php endif;?>
     </div>
     <button type = "submit" class = "btn btn-primary">Save</button> 
     <?php if(!empty($message)):?>
      
      <h1 class="mb-4">Vos Message</h1>
      <?php foreach($messages as $message):?>
      <?=$message->toHTML();?>
      <?php endforeach;?>
     <?php endif;?> 

    


 </form>
</div>
</div>
<?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'footer.php'; ?>