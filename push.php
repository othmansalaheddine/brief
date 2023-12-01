<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/"></script>
    <title>Document</title>
</head>
<body>
<?php
include "host.php";
$selectedRole = "arduino";
$name = "";
$city = "";
$country = "";
$new_price = 0;
$nameimage = "";
if (isset($_POST["role"])) {
  $selectedRole = $_POST["role"];
  
  echo "<h1>Selected Role: $selectedRole</h1>";
}
if (isset($_FILES['imageToUpload'])) {
  $nameimage = $_FILES['imageToUpload']['name'];
}

else {
    echo "image not found!";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $new_price = $_POST["new_price"];
    
    if ($name == "" && empty($nameimage) && $city == "" && $country == "" && $new_price == 0) {
      echo 'error';
  }else if($name != "" && !empty($nameimage) && $city != "" && $country != "" && $new_price != 0){
    move_uploaded_file($_FILES['imageToUpload']['tmp_name'], "assets/image/" . $_FILES['imageToUpload']['name']);
    $sql3 = "SELECT id FROM category WHERE name = '$selectedRole'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
  $row3 = $result3->fetch_assoc();
  $id_category = $row3['id'];
} else {
  // Category not found
  $id_category = null;
}
    // Insert the data into the MySQLi table
    $sql = "INSERT INTO product (name, new_price , category , city, country,image) VALUES ('$name', '$nameimage' , '$id_category' , '$city' , '$country' , '$nameimage')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }else{
    echo 'failed';
  }
}


  


?>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <div class="fixed z-40 w-[100vw]">
      <div class="antialiased bg-gray-100 dark-mode:bg-gray-900 border-black border-opacity-20 drop-shadow-xl border-spacing-1 border-2">
      <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
        <div x-data="{ open: true }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
          <div class="flex flex-row items-center justify-between p-4">
            <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">ELECTRONACER</a>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
              <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
          </div>
          <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
            <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="index.php">Home</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="tailwind.php">tailwind</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="admin.php">admin</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="sign.php">Sign</a>
            <div @click.away="open = false" class="relative" x-data="{ open: true }">
              <button @click="open = !open" class="flex flex-row text-gray-900 bg-gray-200 items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <span>More</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button>
              <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full md:max-w-screen-sm md:w-screen mt-2 origin-top-right">
                <div class="px-2 pt-2 pb-4 bg-white rounded-md shadow-lg dark-mode:bg-gray-700">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a class="flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="push.php">
                      <div class="bg-gradient-to-tr from-indigo-600 to-purple-600 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                      </div>
                      <div class="ml-3">
                        <p class="font-semibold">Push</p>
                        <p class="text-sm">Easy customization</p>
                      </div>
                    </a>
    
                    <a class=" flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="comment.php">
                      <div class="bg-gradient-to-tr from-indigo-600 to-purple-600 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                      </div>
                      <div class="ml-3">
                        <p class="font-semibold">Comments</p>
                        <p class="text-sm">Check your latest comments</p>
                      </div>
                    </a>
    
                    <a class=" flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">
                      <div class="bg-gradient-to-tr from-indigo-600 to-purple-600 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4"><path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                      </div>
                      <div class="ml-3">
                        <p class="font-semibold">Analytics</p>
                        <p class="text-sm">Take a look at your statistics</p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>    
          </nav>
        </div>
      </div>
    </div>
      </div>
      <section class="py-10 bg-gray-100">
        <div class="mx-auto grid max-w-6x gap-6 p-6 w-96">
      <article class="rounded-xl mt-10  bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a >
        <form  method="POST" enctype="multipart/form-data">
          <div class="relative flex items-end overflow-hidden rounded-xl">
          
    
            <input type="file" name="imageToUpload">

    
          
            
          </div>
  
          <div class="mt-10 p-2">
            <div class="flex">
            <input class="text-slate-700" placeholder="name" name="name"></input>
            <select id="roleSelect" value="1" name="role" >
            <?php
                $sql2 = "SELECT * FROM category";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                  while ($row2 = $result2->fetch_assoc()) {
                    echo '
                      
                          
                            <option value="' . $row2['name'] . '" id="' . $row["id"] . '">' . $row2['name'] . '</option>
                            
                          
                         
                        
                    ';
                  }
                }
                ?>
      </select>
            
            </div>
            <div class="mt-1 text-sm text-slate-400 flex">
              <input type="text" placeholder="city" name="city"><input type="text" placeholder="country" name="country">
            </div>
  
            <div class="mt-3 flex items-end justify-between">
                <input class="text-lg font-bold text-blue-500 to-blue-500" placeholder="price" name="new_price"></input>
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                <button type="submit" name="submit" value="Submit" class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <a  class="text-sm">submit</a>
                </button>
              </div>
            </div>
          </div>
          </form>
        </a>
      </article>
      </div>
      
      </section>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="roleselect.js"></script>
</body>
</html>