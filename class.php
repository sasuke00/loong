<?php 
 class  Main{
  //login function 
  public function login($username,$password){
   global $pdo;
    $query = $pdo->prepare("SELECT * from users WHERE username = ? and password = ?");
    $query->bindValue(1,$username);
    $query->bindValue(2,$password);
    $query->execute();
    $rows = $query->fetch(PDO::FETCH_NUM);

    if($rows > 0){
     $_SESSION['user_id'] = $rows[0];
     header('Location: hc2.php');
     exit();   
     }else{
       echo  'Username or Password is incorrect ';   
           }
  }
  
  //check user is logged in or not 
  public function logged_in(){
   return (isset($_SESSION['user_id'])) ? true : false; 
  }
  //fetch user data by user id 
  public function user_data($user_id){
    global $pdo;
    $query = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
    $query->bindvalue(1,$user_id);
    $query->execute();
    return $query->fetch();
   }
  //fetching posts from database
  public function posts(){
   global $pdo;
   $query = $pdo->prepare("SELECT * FROM `posts`,`users` WHERE user_id = user_id_p ORDER BY `post_id` DESC");
   $query->execute();
   return $query->fetchAll();
  }
  //fetching notice from database
  public function notices(){
    global $pdo;
    $today = date('Y-m-d');
    $query = $pdo->prepare("SELECT * FROM `public_notice` WHERE notice_date >= '".$today."' ORDER BY `notice_date` ASC");
    $query->execute();
    return $query->fetchAll();
   }
  //add new text if user post without image
  public function post_text($user_id,$status){
    global $pdo; 
    $query = $pdo->prepare('INSERT INTO `posts` (`post_id`, `user_id_p`, `status`, `status_image`, `status_time`) VALUES (NULL, ?, ?,NULL,  CURRENT_TIMESTAMP)');
    $query->bindValue(1,$user_id);
    $query->bindValue(2,$status);
    $query->execute();
    header('Location: hc2.php');
   }
  //add new post if user post with image
  public function add_post($user_id,$status,$file_parh){
   global $pdo; 
   if(empty($file_parh)){
    $file_parh = 'NULL';
   }
   $query = $pdo->prepare('INSERT INTO `posts` (`post_id`, `user_id_p`, `status`, `status_image`, `status_time`) VALUES (NULL, ?, ?,?,  CURRENT_TIMESTAMP)');
   $query->bindValue(1,$user_id);
   $query->bindValue(2,$status);
   $query->bindValue(3,$file_parh);
   $query->execute();
   header('Location: hc2.php');
  }
  //add new notice (public page) 
  public function post_notice($notice_date,$notice_name){
    global $pdo; 
    $query = $pdo->prepare('INSERT INTO `public_notice` (`notice_id`, `notice_date`, `notice_name`) VALUES (NULL, ?, ?)');
    $query->bindValue(1,$notice_date);
    $query->bindValue(2,$notice_name);
    $query->execute();
    header('Location: hc2.php');
   }

  //---------------Public-------------------
  //fetching posts from database
  public function public_posts(){
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM `public`,`users` WHERE user_id = user_id_p ORDER BY `post_id` DESC");
    $query->execute();
    return $query->fetchAll();
   }
    //add new text if user post without image
    public function add_text($user_id,$status){
     global $pdo; 
     $query = $pdo->prepare('INSERT INTO `public` (`post_id`, `user_id_p`, `status`, `status_image`, `status_time`) VALUES (NULL, ?, ?,NULL,  CURRENT_TIMESTAMP)');
     $query->bindValue(1,$user_id);
     $query->bindValue(2,$status);
     $query->execute();
     header('Location: hc3.php');
    }
   //add new post if user post with image
   public function public_add_post($user_id,$status,$file_parh){
    global $pdo; 
    if(empty($file_parh)){
      $file_parh = 'NULL';
    }
    $query = $pdo->prepare('INSERT INTO `public` (`post_id`, `user_id_p`, `status`, `status_image`, `status_time`) VALUES (NULL, ?, ?,?,  CURRENT_TIMESTAMP)');
    $query->bindValue(1,$user_id);
    $query->bindValue(2,$status);
    $query->bindValue(3,$file_parh);
    $query->execute();
    header('Location: hc3.php');
   }
  ///////////////////////////////////////////////////////////////
  //timeAgo Function
  public function timeAgo($time_ago){

   $time_ago = strtotime($time_ago);
   $cur_time   = time();
   $time_elapsed   = $cur_time - $time_ago;
   $seconds    = $time_elapsed ;
   $minutes    = round($time_elapsed / 60 );
   $hours      = round($time_elapsed / 3600);
   $days       = round($time_elapsed / 86400 );
   $weeks      = round($time_elapsed / 604800);
   $months     = round($time_elapsed / 2600640 );
   $years      = round($time_elapsed / 31207680 );
   // Seconds
   if($seconds <= 60){
       return "just now";
   }
   //Minutes
   else if($minutes <=60){
       if($minutes==1){
           return "one minute ago";
       }
       else{
           return "$minutes minutes ago";
       }
   }
   //Hours
   else if($hours <=24){
       if($hours==1){
           return "an hour ago";
       }else{
           return "$hours hrs ago";
       }
   }
   //Days
   else if($days <= 7){
       if($days==1){
           return "yesterday";
       }else{
           return "$days days ago";
       }
   }
   //Weeks
   else if($weeks <= 4.3){
       if($weeks==1){
           return "a week ago";
       }else{
           return "$weeks weeks ago";
       }
   }
   //Months
   else if($months <=12){
       if($months==1){
           return "a month ago";
       }else{
           return "$months months ago";
       }
   }
   //Years
   else{
       if($years==1){
           return "one year ago";
       }else{
           return "$years years ago";
       }
   }
  }
 }
?>