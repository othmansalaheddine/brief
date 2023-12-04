
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/style_admin.css">
  <script src="https://cdn.tailwindcss.com/"></script>
 
  <!-- <script src="tailwind.config.js"></script> -->
</head>

<body>
<?php
require './back/connexion/host.php';

if (isset($_POST["Supp"])) {
  $id = isset($_POST["Supp"]) ? $_POST["Supp"] : null;

  if ($id !== null) {
    $sql1 = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql1) === TRUE) {
      // Successfully deleted the record
    } else {
      echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
  } else {
    echo "Invalid user ID";
  }
}

$selectedRole = "Unverified";

if (isset($_POST["role"])) {
  $selectedRole = $_POST["role"];
  $userId = isset($_POST["userId"]) ? $_POST["userId"] : "";
  echo "<h1>Selected Role: $selectedRole</h1>";

  if (!empty($userId)) {
    $sql2 = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
      $sql3 = "UPDATE users SET type = ? WHERE id = $userId";

      $stmt = $conn->prepare($sql3);

      $stmt->bind_param("s", $selectedRole);

      $result = $stmt->execute();

      if ($result) {
        echo "<p>Update successful.</p>";
      } else {
        echo "<p>Error updating the database.</p>";
      }

      $stmt->close();
    } else {
      echo "<p>User not found.</p>";
    }
  } else {
    echo "<p>No user ID provided.</p>";
  }
} else {
  echo 'www';
}
?>
  <!-- component -->
  <!-- component -->

  <div class="">
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
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
              </button>
              <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full md:max-w-screen-sm md:w-screen mt-2 origin-top-right">
                <div class="px-2 pt-2 pb-4 bg-white rounded-md shadow-lg dark-mode:bg-gray-700">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a class=" flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">
                      <div class="bg-gradient-to-tr from-indigo-600 to-purple-600 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4">
                          <path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                      </div>
                      <div class="ml-3">
                        <p class="font-semibold">Appearance</p>
                        <p class="text-sm">Easy customization</p>
                      </div>
                    </a>

                    <a class="flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="comment.php">
                      <div class="bg-gradient-to-tr from-indigo-600 to-purple-600 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4">
                          <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                      </div>
                      <div class="ml-3">
                        <p class="font-semibold">Comments</p>
                        <p class="text-sm">Check your latest comments</p>
                      </div>
                    </a>

                    <a class=" flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">
                      <div class="bg-gradient-to-tr from-indigo-600 to-purple-600 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4">
                          <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                          <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
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
  <div class="bg-gray-50 min-h-screen" id="content">

    <div>
      <div class="p-4">
        <div class="bg-white p-4 rounded-md">
          <div>
            <h2 class="mb-4 text-xl font-bold text-gray-700">Admin & User</h2>
            <table class="table-auto w-full ">
              <thead class="justify-between bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-md py-2 px-4 text-white font-bold text-md w-full" >
                <tr class="rounded-md" > 
                  <th class="px-4 py-2">Name</th>
                  <th class="px-4 py-2">Email</th>
                  <th class="px-4 py-2">Role</th>
                  <th class="px-4 py-2">Phone</th>
                  <th class="px-4 py-2">Edit</th>
                </tr>
              </thead>
              <tbody>
                <form method="post">
                <?php
                $sql4 = "SELECT * FROM users";
                $result = $conn->query($sql4);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '
                      <tr>
                        <td class="border px-4 py-2">'.$row["username"].'</td>
                        <td class="border px-4 py-2">'.$row["email"].'</td>
                        <td class="border px-4 py-2">'.$row["type"].'</td>
                        <td class="border px-4 py-2">'.$row["phone"].'</td>
                        <td class="border px-4 py-2 flex justify-evenly">
                          <select id="roleSelect' . $row["id"] . ' value="' . $row["id"] . '"" name="role" data-user-id="' . $row["id"] . '">
                            <option value="Unverified">Unverified</option>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                          
                          </select>
                          <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                          </svg>

                          <button class="text-sm" name="Supp" value="' . $row['id'] . '">Supprimer</button>
                      </div>
                        </td>
                        </tr>
                    ';
                  }
                }
                ?>
                </form>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="roleselect.js"></script>











</body>

</html>