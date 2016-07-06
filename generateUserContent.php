function generateUserContent(){ // Display's user's posts on their profile
  if (userExists($_GET["username"])){
    $userData=fetchUserData($_GET["username"]);

    if (count($userData)>1){ // If longer than 1, user has written posts, userData[0]= account creation data
      ?>
        <br>
        <h2 class="text-center" style="text-decoration: underline;"><?=$_GET["username"]?>'s Latest Posts</h2>
        <br>
      <?php
      // Generate divs for each user post, not including user data
      foreach (array_slice($userData,1) as $i){
        $posttext=file_get_contents($i);
        ?>
          <div class='container blogpost'>
            <p style="text-decoration:underline">Post Date</p>
            <table>
              <tr>
                <td>
                  <?=$posttext?>
                </td>
              </tr>
            </table>
          </div>
        <?php
      }
    }else{
      ?>
        <div class='container blogpost'>
          <h2>You have no posts!</h2>
        </div>
      <?php
    }
  }else{
    redirect("./user_home.php")
  }
}