<?php

/*
=======================================================================================================================================
||                                                                                                                                   ||
||                                                                                                                                   ||
||                                                  Ajax Request Handler                                                             ||
||                                                                                                                                   ||
||                                                                                                                                   ||
=======================================================================================================================================
*/

/*
=============================================================================
||
||                             Admin
||
=============================================================================
*/


// =================== Admin Profile Picture Ajax Handler code ===================

if (isset($_POST['type'])) {

    if (!empty($_FILES['profilePicture']['name'])) {

        $fileName = $_FILES['profilePicture']['name'];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $validExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $validExtensions)) {

            $newName = rand() . "." . $extension;

            $path = "assets/images/profile/" . $newName;

            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $path)) {

                include 'include/classes/adminClass.php';

                $obj = new Admin();

                if ($obj->updateProfilePicture($path)) {
                    echo "Profile Picture Updated";
                } else
                    echo "Internal Error ....";
            }
        } else
            echo "Invalid type, Please Select (png, jpg, jpeg)";
    } else
        echo "No file selected...";
}


// =================== Admin Update Profile Ajax Handler code ===================

if (isset($_POST['restData'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    include 'include/classes/adminClass.php';

    $obj = new Admin();

    if ($obj->updateProfile($name, $email, $mobile, $address))
        echo "Profile Updated";
    else
        echo "DB Error...";
}

// =================== Admin Password Ajax Handler code ===================

if (isset($_POST['pass'])) {

    include 'include/classes/adminClass.php';

    $obj = new Admin();

    $oldPass = $_POST['oldPass'];

    $newPass = $_POST['newPass'];

    $cfrmPass = $_POST['cfrmPass'];

    if ($newPass != $cfrmPass) {
        echo "New Password not match";
    } else {
        if ($obj->updatePassword($oldPass, $newPass)) {
            echo "Password Changed";
        } else
            echo 'Old Password not match';
    }
}

// =================== Admin Login Ajax Handler code ===================

if (isset($_POST['adminLoginForm'])) {

    include 'include/classes/adminClass.php';

    $adminLogin = new Admin();

    $adminLoginEmail = strtolower($_POST['adminEmail']);

    $adminLoginPass = $_POST['adminPass'];

    if ($adminLogin->adminLogin($adminLoginEmail, $adminLoginPass)) {

        session_start();

        $_SESSION['AdminEmail'] = "Admin";

        echo "success";
    } else
        echo "Invalid credentials";
}


/*
=============================================================================
||
||                             Parent Category
||
=============================================================================
*/


// =================== Load Parent Category Ajax Handler code ===================

if (isset($_POST['loadParentCategoryData'])) {

    include_once 'include/classes/categoryClass.php';

    $obj = new Category();

    $outPut = '<table class="table table-hover table-bordered text-center" id="categoryTable">
                <thead>
                     <tr>
                        <th class="px-3">ID</th>
                        <th class="px-3">Name</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                      </tr>
                 </thead>
                
                 <tbody id="allCat">';

    foreach ($obj->fetchData() as $val) {

        $outPut .= "<tr>
                        <td class='text-uppercase' id='catid'>{$val['CategoryID']}</td>
                        <td>{$val['CategoryName']}</td>
                        <td class='text-center'><button type='button' class='btn btn-sm btn-info infobx' data-bs-toggle='modal' data-bs-target='#info' data-iid='{$val['CategoryID']}'><i class='bi bi-info-circle'></i></button></td>
                        <td class='text-center'><a href='updateCategory.php?id={$val['CategoryID']}' class='btn btn-success btn-sm'><i class='bi bi-pencil-square'></i></a></td>
                        <td class='text-center'><button type='button' class='btn btn-sm btn-danger del' data-id='{$val['CategoryID']}'><i class='bi bi-trash3-fill'></i></button></td>
                    </tr>";
    }

    $outPut .= '
                </tbody>
            </table>';

    echo $outPut;
}


// =================== Insert Parent Category Ajax Handler code ===================

if (isset($_POST['insertParentCat'])) {

    $parentCatName = $_POST['parentCatName'];

    $parentCatDescription = htmlentities($_POST['parentCatDescription']);

    include_once 'include/classes/categoryClass.php';

    $insertCat = new Category();

    if ($insertCat->insertCategory($parentCatName, $parentCatDescription))
        echo "Category Inserted";
    else
        echo "Category not Inserted";
}

// =================== Show Info Parent Category Ajax Handler code ===================

if (isset($_POST['iid'])) {

    include_once 'include/classes/categoryClass.php';

    $obj = new Category();

    foreach ($obj->fetchDataOnCondition($_POST['iid']) as $val) {
        $infoData = " 
        <table class='table'>
            <tbody>
                <tr>
                    <th>ID:</th>
                    <td class='text-uppercase'> " . $val['CategoryID'] . " </td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td> " . $val['CategoryName'] . " </td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td> " . html_entity_decode($val['CategoryDescription']) . "</td>
                </tr>
                <tr>
                    <th>Inserted:</th>
                    <td> " . $val['InsertedDate'] . " </td>
                </tr>
                <tr>
                    <th>Modified:</th>
                    <td> " . $val['ModifiedDate'] . " </td>
                </tr>
            </tbody>
        </table>";
    }

    echo $infoData;
}

// =================== Delete Parent Category Ajax Handler code ===================

if (isset($_POST['id'])) {

    include_once 'include/classes/categoryClass.php';

    $obj = new Category();

    if ($obj->deleteData($_POST['id']))
        echo 0;
    else
        echo 1;
}

// =================== Update Parent Category Ajax Handler code ===================

if (isset($_POST['updateData'])) {

    $name = $_POST['categoryName'];

    $desc = htmlentities($_POST['categoryDescription']);

    $id = $_POST['catid'];

    include_once 'include/classes/categoryClass.php';

    $obj = new Category();

    if ($obj->updateCategory($name, $desc, $id))
        echo 0;
    else
        echo 1;
}


/*
=============================================================================
||
||                             Child Category
||
=============================================================================
*/


// =================== Load Child Category Ajax Handler code ===================

if (isset($_POST['loadChildCategoryData'])) {

    include_once 'include/classes/childCategoryClass.php';

    $obj = new ChidCategory();

    $outPut = '<table class="table table-hover table-bordered text-center" id="categoryTable">
                <thead>
                     <tr>
                        <th class="px-3">ID</th>
                        <th class="px-3">Name</th>
                        <th class="px-3">Parent</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                      </tr>
                 </thead>
                
                 <tbody id="allCat">';

    foreach ($obj->fetchData() as $val) {

        $outPut .= "<tr>
                        <td class='text-uppercase' id='catid'>{$val['SubCategoryID']}</td>
                        <td>{$val['SubCategoryName']}</td>
                        <td class='bg-light'>{$val['ParentCategory']}</td>
                        <td class='text-center'><button type='button' class='btn btn-sm btn-info chinfobx' data-bs-toggle='modal' data-bs-target='#info' data-chiid='{$val['SubCategoryID']}'><i class='bi bi-info-circle'></i></button></td>
                        <td class='text-center'><a href='updateChildCategory.php?id={$val['SubCategoryID']}' class='btn btn-success btn-sm'><i class='bi bi-pencil-square'></i></a></td>
                        <td class='text-center'><button type='button' class='btn btn-sm btn-danger chddel' data-chdelid='{$val['SubCategoryID']}'><i class='bi bi-trash3-fill'></i></button></td>
                    </tr>";
    }

    $outPut .= '
                </tbody>
            </table>';

    echo $outPut;
}

// =================== Insert Child Category Ajax Handler code ===================

if (isset($_POST['child'])) {

    include_once 'include/classes/childCategoryClass.php';

    $insertChildCat = new ChidCategory();

    $childCatName = $_POST['childCatName'];

    $parentCategoryName = $_POST['parentCategory'];

    $childCatDescription = htmlentities($_POST['childCatDescription']);

    if ($insertChildCat->insertChildCategory($childCatName, $parentCategoryName, $childCatDescription))
        echo "Child Category Inserted";
    else
        echo "Child Category not Inserted";
}


// =================== Show Info Parent Category Ajax Handler code ===================

if (isset($_POST['chiidbx'])) {

    include_once 'include/classes/childCategoryClass.php';

    $infoChild = new ChidCategory();

    foreach ($infoChild->fetchDataOnCondition($_POST['chiidbx']) as $val) {
        $infoData = " 
        <table class='table'>
            <tbody>
                <tr>
                    <th>ID:</th>
                    <td class='text-uppercase'> " . $val['SubCategoryID'] . " </td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td> " . $val['SubCategoryName'] . " </td>
                </tr>
                <tr>
                    <th>Parent Category:</th>
                    <td> " . $val['ParentCategory'] . " </td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td> " . html_entity_decode($val['SubCategoryDescription']) . "</td>
                </tr>
                <tr>
                    <th>Inserted:</th>
                    <td> " . $val['InsertedDate'] . " </td>
                </tr>
                <tr>
                    <th>Modified:</th>
                    <td> " . $val['ModifiedDate'] . " </td>
                </tr>
            </tbody>
        </table>";
    }

    echo $infoData;
}

// =================== Delete Child Category Ajax Handler code ===================

if (isset($_POST['chdel'])) {

    include_once 'include/classes/childCategoryClass.php';

    $delChild = new ChidCategory();

    if ($delChild->deleteData($_POST['chdel']))
        echo 0;
    else
        echo 1;
}

// =================== Update Child Category Ajax Handler code ===================

if (isset($_POST['updateChildCatData'])) {

    $updateChildID = $_POST['updateChdID'];

    $updateChildName = $_POST['updateChdName'];

    $updateChildDesc = htmlentities($_POST['desc']);

    include_once 'include/classes/childCategoryClass.php';

    $updateChildCat = new ChidCategory();

    if ($updateChildCat->updateCategory($updateChildName, $updateChildDesc, $updateChildID))
        echo "Child Category Updated";
    else
        echo "Child Category not Updated";
}

// =================== Update Parent Category Ajax Handler code ===================


if (isset($_POST['updateParentFChild'])) {

    include_once 'include/classes/childCategoryClass.php';

    $parentC = new ChidCategory();

    $updateParentCategoryFourChild = $_POST['updateParentCate'];

    $parentIDforChild = $_POST['childIDP'];

    if ($parentC->updateParentCategory($parentIDforChild, $updateParentCategoryFourChild))
        echo "Parent Category Updated";
    else
        echo "Parent Category not Updated";
}



/*
=============================================================================
||
||                             Product
||
=============================================================================
*/



// =================== Insert Product Ajax Handler code ===================

if (isset($_POST['insertPdocut'])) {

    if (!empty($_FILES['productPicture']['name'])) {

        $fileName = $_FILES['productPicture']['name'];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $validExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $validExtensions)) {

            $newName = rand() . "." . $extension;

            $path = "assets/images/products/" . $newName;


            $tempFilePath = $_FILES['productPicture']['tmp_name'];



            if (move_uploaded_file($_FILES['productPicture']['tmp_name'], $path)) {



                $productName = $_POST['productName'];

                $productCategory = $_POST['productCategory'];

                $productDescription = htmlentities($_POST['productDescription']);

                $productPrice = $_POST['productPrice'];

                $productStock = $_POST['productStock'];

                include 'include/classes/productClass.php';

                $insertProduct = new Product();

                if ($insertProduct->insertProduct($path, $productName, $productCategory, $productDescription, $productPrice, $productStock)) {
                    echo "Product Inserted";
                } else
                    echo "Internal Error ....";
            }
        } else
            echo "Invalid type, Please Select (png, jpg, jpeg)";
    }
}

// =================== Show Product Ajax Handler code ===================

if (isset($_POST['loadProductData'])) {

    include_once 'include/classes/productClass.php';

    $showData = new Product();

    $outPut = '<table class="table table-bordered table-hover text-center" id="productTable">
    <thead>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Details</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
     </thead>
    
     <tbody id="allCat">';

    foreach ($showData->fetchData() as $val) {

        $outPut .= "<tr>
            <td class='text-uppercase' id='catid'>{$val['ProductID']}</td>
            <td>{$val['ProductName']}</td>
            <td>{$val['ProductCategory']}</td>
            <td>{$val['ProductPrice']}</td>
            <td>{$val['ProductStock']}</td>
            <td class='text-center'><button type='button' class='btn btn-sm btn-info proinfobx' data-bs-toggle='modal' data-bs-target='#proinfo' data-prodinfo='{$val['ProductID']}'><i class='bi bi-info-circle'></i></button></td>
            <td class='text-center'><a href='updateProduct.php?id={$val['ProductID']}' class='btn btn-success btn-sm'><i class='bi bi-pencil-square'></i></a></td>
            <td class='text-center'><button type='button' class='btn btn-sm btn-danger delpbtn' data-proid='{$val['ProductID']}'><i class='bi bi-trash3-fill'></i></button></td>
        </tr>";
    }

    $outPut .= '
    </tbody>
</table>';

    echo $outPut;
}

// =================== Delete Product Ajax Handler code ===================

if (isset($_POST['delProduct'])) {

    $prodID = $_POST['delProduct'];

    include_once 'include/classes/productClass.php';

    $delProd = new Product();

    if ($delProd->deleteProduct($prodID))
        echo 0;
    else
        echo 1;
}

// =================== Info box Product Ajax Handler code ===================

if (isset($_POST['infoProd'])) {


    include_once 'include/classes/productClass.php';

    $showProdInfo = new Product();

    foreach ($showProdInfo->fetchDataOnCondition($_POST['infoProd']) as $val) {

        $infoData = " 
        <table class='table'>
            <tbody>
                <tr>
                    <th>Picture:</th>
                    <td> <img src=" . $val['ProductPic'] . " width = '140px' height = '140px'/> </td>
                </tr>
                <tr>
                    <th>ID:</th>
                    <td class='text-uppercase'> " . $val['ProductID'] . " </td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td> " . $val['ProductName'] . " </td>
                </tr>
                <tr>
                    <th>Category:</th>
                    <td> " . $val['ProductCategory'] . " </td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td> " . html_entity_decode($val['ProductDescription']) . "</td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td> " . $val['ProductPrice'] . " </td>
                </tr>
                <tr>
                    <th>Stock:</th>
                    <td> " . $val['ProductStock'] . " </td>
                </tr>
                <tr>
                    <th>Inserted:</th>
                    <td> " . $val['InsertedDate'] . " </td>
                </tr>
                <tr>
                    <th>Modified:</th>
                    <td> " . $val['ModifiedDate'] . " </td>
                </tr>
            </tbody>
        </table>";
    }

    echo $infoData;
}

// =================== Update Product Picture Ajax Handler code ===================

if (isset($_POST['updateProPicture'])) {

    include_once 'include/classes/productClass.php';

    $updateProPic = new Product();

    if (!empty($_FILES['updateProdPicture']['name'])) {

        $fileName = $_FILES['updateProdPicture']['name'];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $validExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $validExtensions)) {

            $newName = rand() . "." . $extension;

            $path = "assets/images/products/" . $newName;

            $tempFilePath = $_FILES['updateProdPicture']['tmp_name'];


            if (move_uploaded_file($_FILES['updateProdPicture']['tmp_name'], $path)) {

                if ($updateProPic->updateProductPicture($path, $_POST['prodIDPic'])) {
                    echo "Product Picture Updated";
                } else
                    echo "Internal Error ....";
            }
        }
    } else
        echo "Invalid type, Please Select (png, jpg, jpeg)";
}



// =================== Update Product Details Ajax Handler code ===================

if (isset($_POST['updatePDetails'])) {

    include_once 'include/classes/productClass.php';

    $updatePDetails = new Product();

    if ($updatePDetails->updateproductDetails($_POST['updateProdName'], $_POST['updateProdCategory'], htmlentities($_POST['updateProdDescription']), $_POST['updateProdPrice'], $_POST['updateProductStock'], $_POST['prodID']))
        echo "Product Details Updated";
    else
        echo "Product Details not Updated";
}



/*
=============================================================================
||
||                             Users
||
=============================================================================
*/



// =================== Load All Users Ajax Handler code ===================

if (isset($_POST['loadUsersTableData'])) {

    include 'include/classes/database.php';

    $getUsers = new Database();

    $data = '<table class="table text-center table-bordered ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Details</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
    <tbody>';

    $getUsers->select('ops_users', "*", null, null, null, null);

    foreach ($getUsers->getResult() as $value) {

        $data .= '<tr>
                    <td class="text-uppercase">' . $value['UserID'] . '</td>
                    <td>' . $value['UserName'] . '</td>
                    <td>' . $value['UserEmail'] . '</td>
                    <td>' . $value['UserMobile'] . '</td>
                    <td><button type="button" class="btn btn-info btn-sm userDetails" data-bs-toggle="modal" data-detus="' . $value['UserID'] . '" data-bs-target="#userDet"><i class="bi bi-info-circle"></i></button></td>
                    <td><a href="updateUser.php?id=' . $value['UserID'] . '" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a></td>
                    <td><button type="button" class="btn btn-danger btn-sm deleteUser" data-usid="' . $value['UserID'] . '"><i class="bi bi-trash3-fill"></i></button></td>
                </tr>';
    }

    $data .= '  </tbody>
              </table>';

    echo $data;
}

// =================== Show User Details Modal Ajax Handler code ===================


if (isset($_POST['userID'])) {

    $userID = $_POST['userID'];

    include 'include/classes/database.php';

    $showUserDetails = new Database();

    $showUserDetails->select("ops_users", '*', null, "UserID = '$userID'", null, null);

    foreach ($showUserDetails->getResult() as $val) {

        $infoData = " 
        <table class='table'>
            <tbody>
                <tr>
                    <th>Picture:</th>
                    <td> <img src=" . str_replace('admin/', "", $val['UserImage']) . " width = '140px' height = '140px'/> </td>
                </tr>
                <tr>
                    <th>ID:</th>
                    <td class='text-uppercase'> " . $val['UserID'] . " </td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td> " . $val['UserName'] . " </td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td> " . $val['UserEmail'] . " </td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td> " . html_entity_decode($val['UserAddress']) . "</td>
                </tr>
                <tr>
                    <th>Mobile:</th>
                    <td> " . $val['UserMobile'] . " </td>
                </tr>
                <tr>
                    <th>Register:</th>
                    <td> " . $val['RegisterDate'] . " </td>
                </tr>
            </tbody>
        </table>";
    }


    echo $infoData;
}

// =================== Insert New User Ajax Handler code ===================

if (isset($_POST['AddNewU'])) {

    if (!empty($_FILES['userPic']['name'])) {

        $fileName = $_FILES['userPic']['name'];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $validExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $validExtensions)) {

            $newName = rand() . "." . $extension;

            $path = "assets/images/userProfile/" . $newName;

            if (move_uploaded_file($_FILES['userPic']['tmp_name'], $path)) {

                $userName = $_POST['userName'];

                $userEmail = strtolower($_POST['userEmail']);

                $userPass = $_POST['userPass'];

                $userMobile = $_POST['userMobile'];

                $userAddress = $_POST['userAddress'];

                include_once '../users.php';

                $newUser = new Users();

                if ($newUser->userExist($userEmail))

                    echo " User already exists. Please choose a different email.";

                else
                    if ($newUser->addNewUser($userName, $userEmail, $userAddress, $path, $userPass, $userMobile))
                    echo "User added";
                else
                    echo "User not added";
            }
        } else
            echo "Invalid Picture type, Please Select (png, jpg, jpeg)";
    }
}


// =================== Delete User Ajax Handler code ===================

if (isset($_POST['delUser'])) {

    include_once '../users.php';

    $delUser = new Users();

    if ($delUser->deleteUser($_POST['delUser']))
        echo 0;
    else
        echo 1;
}

// =================== Update User Pic Ajax Handler code ===================

if (isset($_POST['updateUserImage'])) {

    if (!empty($_FILES['updateUserPicture']['name'])) {

        $fileName = $_FILES['updateUserPicture']['name'];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $validExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $validExtensions)) {

            $newName = rand() . "." . $extension;

            $path = "assets/images/userProfile/" . $newName;

            if (move_uploaded_file($_FILES['updateUserPicture']['tmp_name'], $path)) {

                include_once '../users.php';

                $updateUserPic = new Users();

                if ($updateUserPic->updateProfilePic($path, $_POST['userPicID']))
                    echo "User profile picture updated";
                else
                    echo "User profile picture Error....";
            }
        } else
            echo "Invalid Picture type, Please Select (png, jpg, jpeg)";
    }
}

// =================== Update User Details Ajax Handler code ===================

if (isset($_POST['updateUserD'])) {

    include_once '../users.php';

    $updateUsDetails = new Users();

    if ($updateUsDetails->updateProfileDetails($_POST['userName'], strtolower($_POST['userEmail']), $_POST['userAddress'], $_POST['userMobile'], $_POST['userDetailsID']))
        echo "User Details Updated";
    else
        echo "User details Error...";
}

// =================== Update User Password Ajax Handler code ===================

if (isset($_POST['updateUserPassword'])) {

    if ($_POST['userPass'] == $_POST['userConfirmPass']) {

        include_once '../users.php';

        $updateUPass = new Users();

        if ($updateUPass->updatePassword($_POST['userPass'], $_POST['userPassID']))
            echo "Password Updated";
        else
            echo "Something went wrong";
    } else
        echo "Password not match.";
}


/*
=============================================================================
||
||                             Dashboard Working
||
=============================================================================
*/


// =================== Load Total Users Ajax Handler code ===================

if (isset($_POST['loadUsers'])) {

    include 'include/classes/database.php';

    $totalU = new Database();

    $totalU->countRows("ops_users");

    foreach ($totalU->getResult() as $value)
        foreach ($value as $val)
            echo $val;
}

// =================== Load out of Stock product Ajax Handler code ===================

if (isset($_POST['prodTable'])) {

    include 'include/classes/database.php';

    $outOfStock = new Database();

    $outOfStock->select("ops_product", "*", null, "ProductStock <= 0", null, null);

    $cond;

    $prodTable = '<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th scope="col">Picture</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Stock</th>
        </tr>
    </thead>
    <tbody>';

    foreach ($outOfStock->getResult() as $val) {

        $cond = $val['ProductStock'];

        $prodTable .= ' <tr>
                            <td><img src="' . $val['ProductPic'] . '" width="60px" height="60px" /></td>
                            <td class="text-uppercase">' . $val['ProductID'] . '</td>
                            <td>' . $val['ProductName'] . '</td>
                            <td>' . $val['ProductCategory'] . '</td>
                            <td class="h5 text-danger">' . $val['ProductStock'] . '</td>                            
                        </tr>';
    }
    $prodTable .= ' </tbody>
       </table>';


    echo $prodTable;
}

// =================== Low Stock product Ajax Handler code ===================

if (isset($_POST['lowProdTableData'])) {

    include 'include/classes/database.php';

    $lowStock = new Database();

    $lowStock->select("ops_product", "*", null, "ProductStock < 20 AND ProductStock > 0", null, null);

    $lowProdTable = '<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th scope="col">Picture</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Stock</th>
        </tr>
    </thead>
    <tbody>';

    foreach ($lowStock->getResult() as $val) {
        $lowProdTable .= ' <tr>
                                <td><img src="' . $val['ProductPic'] . '" width="60px" height="60px" /></td>
                                <td class="text-uppercase">' . $val['ProductID'] . '</td>
                                <td>' . $val['ProductName'] . '</td>
                                <td>' . $val['ProductCategory'] . '</td>
                                <td class="h5 text-warning">' . $val['ProductStock'] . '</td>                            
                            </tr>';
    }

    $lowProdTable .= "</tr></table>";

    echo $lowProdTable;
}


/*
=============================================================================
||
||                             Site Setting Ajax handling Code
||
=============================================================================
*/

// =================== Update Social Media links Ajax Handler code ===================

if (isset($_POST['links'])) {

    include_once 'include/classes/siteSettingClass.php';

    $updateSocial = new SiteSetting();

    $fb = "";
    $whatsapp = "";
    $insta = "";
    $twitter = "";
    $yt = "";

    if (filter_var($_POST['fb'], FILTER_VALIDATE_URL)) {

        $fb = $_POST['fb'];

        if (filter_var($_POST['wapp'], FILTER_VALIDATE_URL)) {

            $wapp = $_POST['wapp'];

            if (filter_var($_POST['instagram'], FILTER_VALIDATE_URL)) {

                $insta = $_POST['instagram'];

                if (filter_var($_POST['twitter'], FILTER_VALIDATE_URL)) {

                    $twi = $_POST['twitter'];

                    if (filter_var($_POST['youtube'], FILTER_VALIDATE_URL)) {

                        $yt = $_POST['youtube'];


                        if ($updateSocial->updateSocialMediaLinks($fb, $wapp, $insta, $twi, $yt))
                            echo "Social Media links Updated.";
                        else
                            echo "Social Media links not Updated";
                    } else {
                        echo "Invalid youtube URL.";
                    }
                } else {
                    echo "Invalid twitter URL.";
                }
            } else {
                echo "Invalid instagram URL.";
            }
        } else {
            echo "Invalid Whatsapp URL.";
        }
    } else {
        echo "Invalid Facebook URL.";
    }
}

// =================== Update About Us Ajax Handler code ===================

if (isset($_POST['about'])) {

    include_once 'include/classes/siteSettingClass.php';

    $updateAbout = new SiteSetting();

    if ($updateAbout->updateAboutUs($_POST['siteAbout']))
        echo "Data Updated";
    else
        echo "Data not updated";
}

// =================== Update Site Logo Ajax Handler code ===================

if (isset($_POST['siteLogoName'])) {

    $fileName = $_FILES['sitePic']['name'];

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    $validExtensions = array('jpg', 'jpeg', 'png');

    if (in_array($extension, $validExtensions)) {

        $newName = rand() . "." . $extension;

        $path = "assets/images/siteLogo/" . $newName;

        if (move_uploaded_file($_FILES['sitePic']['tmp_name'], $path)) {

            include_once 'include/classes/siteSettingClass.php';

            $siteLogo = new SiteSetting();

            $siteName = $_POST['siteName'];

            if ($siteLogo->updateStieLogo($path, $siteName))
                echo "Site Logo and Name Updated.";
            else
                echo "Site Logo and Name not Updated....";
        }
    } else
        echo "Invalid Picture type, Please Select (png, jpg, jpeg)";
}

// =================== Add banner Ajax Handler code ===================

if (isset($_POST['addBan'])) {


    if (!empty($_FILES['siteBanner']['name'])) {

        $fileName = $_FILES['siteBanner']['name'];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $validExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($extension, $validExtensions)) {

            $newName = rand() . "." . $extension;

            $path = "assets/images/banners/" . $newName;

            if (move_uploaded_file($_FILES['siteBanner']['tmp_name'], $path)) {

                include_once 'include/classes/database.php';

                $banner = new Database();

                if ($banner->insert("ops_sitebanner", ["BannerTitle" => $_POST['bannerTitle'], "BannerDescription" => htmlentities($_POST['bannerDescription']), "BannerImages" => $path])) {
                    echo "Banner Added";
                } else
                    echo "Internal Error ....";
            }
        } else
            echo "Invalid type, Please Select (png, jpg, jpeg)";
    }
}

// =================== Password Recovery Email Ajax Handler code ===================

if (isset($_POST['recovery'])) {

    include_once 'include/classes/siteSettingClass.php';

    $recoveryEmail = new SiteSetting();

    if ($recoveryEmail->addRecoveryEmail(strtolower($_POST['prEmail']), $_POST['appPassword']))
        echo "Recovery Email & Password Added";
    else
        echo "Recovery Email not added Error....";
}


/*
=============================================================================
||
||                             User Cart
||
=============================================================================
*/


// =================== Show User Cart ===================

if (isset($_POST['cart'])) {

    include_once 'include/classes/database.php';

    include_once 'include/classes/productClass.php';

    include_once '../users.php';

    $user = new Users();

    $product = new Product();

    $db = new Database();

    $db->select("ops_usercart", '*', null, null, null, null);

    $cartData = '<table class="table text-center table-bordered" id="userCart">
                    <thead>
                        <tr>
                            <th scope="col">User ID:</th>
                            <th scope="col">User Name:</th>
                            <th scope="col">Cart ID:</th>
                            <th scope="col">Cart Details:</th>
                        </tr>
                    </thead>
                    <tbody>';

    foreach ($db->getResult() as $value) {

        $cartData .= '
                        <tr>
                            <td class="text-uppercase">' . $value['UserID'] . '</td>
                            <td>' . $user->getName($value['UserID']) . '</td>
                            <td>' . $value['CartID'] . '</td>
                            <td>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Product ID:</th>
                                                <th scope="col">Product Price:</th>
                                                <th scope="col">Product Quantity:</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

        $cartID = $value['CartID'];

        $db->select("ops_cartitems", "*", null, "CartID = '$cartID'", null, null);

        foreach ($db->getResult() as $val) {

            $cartData .= '
                                            <tr>
                                                <td><img src="' . $product->getPicture($val['ProductID']) . '" width="40px" height="40px"/></td>
                                                <td class="text-uppercase">' . $val['ProductID'] . '</td>
                                                <td>' . $val['ProductPrice'] . '</td>
                                                <td>' . $val['ProductQuantity'] . '</td>
                                            </tr>';
        }

        $cartData .= ' 
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                ';
    }

    $cartData .= '   </tbody>
                  </table>';

    echo $cartData;
}

// =================== Search User Cart ===================

if (isset($_POST['searchCart'])) {

    $userID = $_POST['searchCart'];

    include_once 'include/classes/database.php';

    include_once 'include/classes/productClass.php';

    include_once '../users.php';

    $user = new Users();

    $product = new Product();

    $db = new Database();

    $db->select("ops_usercart", '*', null, "UserID like '%$userID%'", null, null);

    $cartData = '<table class="table text-center table-bordered" id="userCart">
                    <thead>
                        <tr>
                            <th scope="col">User ID:</th>
                            <th scope="col">User Name:</th>
                            <th scope="col">Cart ID:</th>
                            <th scope="col">Cart Details:</th>
                        </tr>
                    </thead>
                    <tbody>';

    foreach ($db->getResult() as $value) {

        $cartData .= '
                        <tr>
                            <td class="text-uppercase">' . $value['UserID'] . '</td>
                            <td>' . $user->getName($value['UserID']) . '</td>
                            <td>' . $value['CartID'] . '</td>
                            <td>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Product ID:</th>
                                                <th scope="col">Product Price:</th>
                                                <th scope="col">Product Quantity:</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

        $cartID = $value['CartID'];

        $db->select("ops_cartitems", "*", null, "CartID = '$cartID'", null, null);

        foreach ($db->getResult() as $val) {

            $cartData .= '
                                            <tr>
                                                <td><img src="' . $product->getPicture($val['ProductID']) . '" width="40px" height="40px"/></td>
                                                <td class="text-uppercase">' . $val['ProductID'] . '</td>
                                                <td>' . $val['ProductPrice'] . '</td>
                                                <td>' . $val['ProductQuantity'] . '</td>
                                            </tr>';
        }

        $cartData .= ' 
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                ';
    }

    $cartData .= '   </tbody>
                  </table>';

    echo $cartData;
}


/*
=============================================================================
||
||                             User order
||
=============================================================================
*/


// =================== Show User order ===================

if (isset($_POST['order'])) {

    include_once 'include/classes/database.php';

    include_once 'include/classes/productClass.php';

    include_once '../users.php';

    $user = new Users();

    $product = new Product();

    $db = new Database();

    $db->select("ops_userorders", '*', null, null, null, null);

    $orderData = '<table class="table text-center table-bordered" id="userCart">
                    <thead>
                        <tr>
                            <th scope="col">Order ID:</th>    
                            <th scope="col">User ID:</th>
                            <th scope="col">Order Status:</th>
                            <th scope="col">Mobile Number:</th>
                            <th scope="col">Shipping Address:</th>
                            <th scope="col">Order Details:</th>
                            <th scope="col">Total Price:</th>
                        </tr>
                    </thead>
                    <tbody>';

    foreach ($db->getResult() as $value) {

        $orderData .= '
                        <tr>
                            <td>' . $value['OrderID'] . '</td>
                            <td class="text-uppercase">' . $value['UserID'] . '</td>
                            <td style="width: 140px;">
                                <select class="form-select" id="orderStatus">';

        if ($value['OrderStatus'] == "Pending")
            $orderData .= '  <option value="Pending" data-usid="' . $value['UserID'] . '" data-odrid="' . $value['OrderID'] . '" selected>Pending</option>
                                            <option value="Complete" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '">Complete</option>
                                            <option value="Canceled" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '">Canceled</option>';
        else if ($value['OrderStatus'] == "Complete")
            $orderData .= '     <option value="Pending" data-usid="' . $value['UserID'] . '" data-odrid="' . $value['OrderID'] . '">Pending</option>
                                <option value="Complete" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '" selected>Complete</option>
                                <option value="Canceled" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '">Canceled</option>';
        else
            $orderData .= '     <option value="Pending" data-usid="' . $value['UserID'] . '" data-odrid="' . $value['OrderID'] . '">Pending</option>
                                <option value="Complete" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '">Complete</option>
                                <option value="Canceled" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '" selected>Canceled</option>';



        $orderData .= ' 
                                </select>
                           </td>
                           <td>' . $user->getMobileNum($value['UserID']) . '</td>
                           <td>' . $value['ShippingAddress'] . '</td>
                            <td>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Product ID:</th>
                                                <th scope="col">Product Price:</th>
                                                <th scope="col">Product Quantity:</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

        $orderID = $value['OrderID'];

        $db->select("ops_orderitems", "*", null, "OrderID = '$orderID'", null, null);

        foreach ($db->getResult() as $val) {

            $orderData .= '
                                            <tr>
                                                <td><img src="' . $product->getPicture($val['ProductID']) . '" width="40px" height="40px"/></td>
                                                <td class="text-uppercase">' . $val['ProductID'] . '</td>
                                                <td>' . $val['ProductPrice'] . '</td>
                                                <td>' . $val['ProductQuantity'] . '</td>
                                            </tr>';
        }

        $orderData .= ' 
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td>' . $value['TotalPrice'] . '</td>
                        </tr>
                ';
    }

    $orderData .= '   </tbody>
                  </table>';

    echo $orderData;
}


// =================== Search User order ===================

if (isset($_POST['searchOrder'])) {

    $userID = $_POST['searchOrder'];

    include_once 'include/classes/database.php';

    include_once 'include/classes/productClass.php';

    include_once '../users.php';

    $user = new Users();

    $product = new Product();

    $db = new Database();

    $db->select("ops_userorders", '*', null, "UserID like '%$userID%'", null, null);

    $orderData = '<table class="table text-center table-bordered" id="userCart">
                    <thead>
                        <tr>
                            <th scope="col">Order ID:</th>    
                            <th scope="col">User ID:</th>
                            <th scope="col">Order Status:</th>
                            <th scope="col">Mobile Number:</th>
                            <th scope="col">Shipping Address:</th>
                            <th scope="col">Order Details:</th>
                            <th scope="col">Total Price:</th>
                        </tr>
                    </thead>
                    <tbody>';

    foreach ($db->getResult() as $value) {

        $orderData .= '
                        <tr>
                            <td>' . $value['OrderID'] . '</td>
                            <td class="text-uppercase">' . $value['UserID'] . '</td>
                            <td style="width: 140px;">
                                <select class="form-select" id="orderStatus">';

        if ($value['OrderStatus'] == "Pending")
            $orderData .= '  <option value="Pending" data-usid="' . $value['UserID'] . '" data-odrid="' . $value['OrderID'] . '" selected>Pending</option>
                                            <option value="Complete" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '">Complete</option>
                                            <option value="Canceled" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '">Canceled</option>';
        else if ($value['OrderStatus'] == "Complete")
            $orderData .= '     <option value="Pending" data-usid="' . $value['UserID'] . '" data-odrid="' . $value['OrderID'] . '">Pending</option>
                                <option value="Complete" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '" selected>Complete</option>
                                <option value="Canceled" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '">Canceled</option>';
        else
            $orderData .= '     <option value="Pending" data-usid="' . $value['UserID'] . '" data-odrid="' . $value['OrderID'] . '">Pending</option>
                                <option value="Complete" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '">Complete</option>
                                <option value="Canceled" data-usid="' . $value['UserID'] . '"  data-odrid="' . $value['OrderID'] . '" selected>Canceled</option>';



        $orderData .= ' 
                                </select>
                           </td>
                           <td>' . $user->getMobileNum($value['UserID']) . '</td>
                           <td>' . $value['ShippingAddress'] . '</td>
                            <td>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Product ID:</th>
                                                <th scope="col">Product Price:</th>
                                                <th scope="col">Product Quantity:</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

        $orderID = $value['OrderID'];

        $db->select("ops_orderitems", "*", null, "OrderID = '$orderID'", null, null);

        foreach ($db->getResult() as $val) {

            $orderData .= '
                                            <tr>
                                                <td><img src="' . $product->getPicture($val['ProductID']) . '" width="40px" height="40px"/></td>
                                                <td class="text-uppercase">' . $val['ProductID'] . '</td>
                                                <td>' . $val['ProductPrice'] . '</td>
                                                <td>' . $val['ProductQuantity'] . '</td>
                                            </tr>';
        }

        $orderData .= ' 
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td>' . $value['TotalPrice'] . '</td>
                        </tr>
                ';
    }

    $orderData .= '   </tbody>
                  </table>';

    echo $orderData;
}


// =================== Update User order ===================

if (isset($_POST['changeStatus']) && isset($_POST['id'])) {

    $changeStatus = $_POST['changeStatus'];

    $orderID = $_POST['id'];

    $userID = $_POST['userid'];

    include_once 'include/classes/userOrderClass.php';

    $updateStatus = new UserOrders();

    if ($updateStatus->udpateOrderStatus($changeStatus, $userID, $orderID))
        echo "done";
    else
        echo "notdone";
}
