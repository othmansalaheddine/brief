
<?php
session_start(); 
    require 'back/connexion/host.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<body class="bg-white">
    
    <!-- Header Navbar -->
    <?php 
    require 'header.php';
    
    ?>
    <div class=" relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full mt-44 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                id
                </th>
                <th scope="col" class="px-6 py-3">
                date creation
                </th>
                <th scope="col" class="px-6 py-3">
                date envoi
                </th>
                <th scope="col" class="px-6 py-3">
                date livraison  
                </th>
                <th scope="col" class="px-6 py-3">
                prix total
                </th>
                <th scope="col" class="px-6 py-3">
                id client
                </th>
                <th scope="col" class="px-6 py-3">
                etat
                </th>
               valide 
                <th scope="col" class="px-6 py-3">
                annuler
                </th>
                
                
            </tr>
        </thead>
        <tbody>
          <!-- 
        <td class="px-6 py-4">
               
        </td>
        --->
       <?php
       //idcom, date_creation, date_envoi, date_livraison, prix_total, idclient, etat
       $sql = "SELECT * from commande";
       $sqlrun = mysqli_query($conn,$sql);
       while($row = mysqli_fetch_assoc($sqlrun)){
        ?>
        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          <?=$idcom?>
        </th>
        <td class="px-6 py-4">
             <?=$date_creation?>
        </td>
        <td class="px-6 py-4">
        <?=$date_envoi?>
        </td>
        <td class="px-6 py-4">
            <?=$date_livraison?> 
        </td>
        <td class="px-6 py-4">
        <?=$prix_total?> 
        </td>
        <td class="px-6 py-4">
        <?=$idclient?> 
        </td>
        <td class="px-6 py-4">
        <?=$etat?> 
        </td>
        <td class="px-6 py-4">
        <form methode = 'GET'>
          <button class="bg-blue-500 text-white px-4 py-2 rounded-md "  name ="valide" value = '<?=$id?>'>update</button>
        </form>
       </td>
       <td class="px-6 py-4">
        <form methode = 'GET'>
          <button class="bg-blue-500 text-white px-4 py-2 rounded-md "  name ="annuler" value = '<?=$id?>'>see</button>
        </form>
       </td>
      
    </tr>
    <?php
    }
    ?>
       
       
        </tbody>
    </table>
</div>
          <button type="submit"  class="inline-flex  bg-slate-900 items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
             <a href="category.php">see the category</a> 
          </button>
</body>
</html>