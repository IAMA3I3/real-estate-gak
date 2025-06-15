<?php

// update location
function updateLocation($pdo, $location_id, $image, $name)
{
    if ($image) {
        $query = "UPDATE locations SET image = :image, name = :name WHERE location_id = :location_id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam("image", $image);
    } else {
        $query = "UPDATE locations SET name = :name WHERE location_id = :location_id;";
        $stmt = $pdo->prepare($query);
    }
    $stmt->bindParam("location_id", $location_id);
    $stmt->bindParam("name", $name);
    $stmt->execute();
}

// edit location error
function editLocationError($pdo, $location_id, $name)
{
    $errors = [];

    $name = trim($name);

    if (empty($name)) {
        $errors['name'] = "Location is required";
    }
    if (!empty($name) && takenByOther($pdo, "locations", "name", $name, "location_id", $location_id)) {
        $errors['name'] = "Location already exists";
    }

    return $errors;
}

// add location
function addLocation($pdo, $location_id, $image, $name)
{
    $query = "INSERT INTO locations (location_id, image, name) VALUES (:location_id, :image, :name);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("location_id", $location_id);
    $stmt->bindParam("image", $image);
    $stmt->bindParam("name", $name);
    $stmt->execute();
}

// add location error
function addLocationError($pdo, $name)
{
    $errors = [];

    $name = trim($name);

    if (empty($name)) {
        $errors['name'] = "Location is required";
    }
    if (!empty($name) && taken($pdo, "locations", "name", $name)) {
        $errors['name'] = "Location already exists";
    }

    return $errors;
}

// Function to add document to database
function addDocument($pdo, $document_id, $rent_id, $name, $document)
{
    $query = "INSERT INTO documents (document_id, rent_id, name, document) VALUES (:document_id, :rent_id, :name, :document);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("document_id", $document_id);
    $stmt->bindParam("rent_id", $rent_id);
    $stmt->bindParam("name", $name);
    $stmt->bindParam("document", $document);
    $stmt->execute();
}

// Validation function for document data
function validateDocumentData($name, $filePath)
{
    $errors = [];

    // Validate name
    if (empty(trim($name))) {
        $errors['name'] = "Document name is required.";
    } elseif (strlen(trim($name)) < 3) {
        $errors['name'] = "Document name must be at least 3 characters long.";
    } elseif (strlen(trim($name)) > 255) {
        $errors['name'] = "Document name must not exceed 255 characters.";
    }

    // Validate file path
    if (empty($filePath)) {
        $errors['file'] = "Document file is required.";
    }

    return empty($errors) ? false : $errors;
}

// add property
function updateProperty($pdo, $property_id, $images, $name, $description, $landlord_id, $price, $location_id, $address, $latitude, $longitude, $status, $type, $size, $livingroom, $bedroom, $bathroom, $property_condition, $features)
{
    $query = "UPDATE properties SET images = :images, name = :name, description = :description, landlord_id = :landlord_id, price = :price, location_id = :location_id, address = :address, latitude = :latitude, longitude = :longitude, status = :status, type = :type, size = :size, livingroom = :livingroom, bedroom = :bedroom, bathroom = :bathroom, property_condition = :property_condition, features = :features WHERE property_id = :property_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("property_id", $property_id);
    $stmt->bindParam("images", $images);
    $stmt->bindParam("name", $name);
    $stmt->bindParam("description", $description);
    $stmt->bindParam("landlord_id", $landlord_id);
    $stmt->bindParam("price", $price);
    $stmt->bindParam("location_id", $location_id);
    $stmt->bindParam("address", $address);
    $stmt->bindParam("latitude", $latitude);
    $stmt->bindParam("longitude", $longitude);
    $stmt->bindParam("status", $status);
    $stmt->bindParam("type", $type);
    $stmt->bindParam("size", $size);
    $stmt->bindParam("livingroom", $livingroom);
    $stmt->bindParam("bedroom", $bedroom);
    $stmt->bindParam("bathroom", $bathroom);
    $stmt->bindParam("property_condition", $property_condition);
    $stmt->bindParam("features", $features);
    $stmt->execute();
}

// add rent
function addRent($pdo, $rent_id, $property_id, $landlord_id, $tenant_id, $rent_start, $rent_end)
{
    $query = "INSERT INTO rents (rent_id, property_id, landlord_id, tenant_id, rent_start, rent_end) VALUES (:rent_id, :property_id, :landlord_id, :tenant_id, :rent_start, :rent_end);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("rent_id", $rent_id);
    $stmt->bindParam("property_id", $property_id);
    $stmt->bindParam("landlord_id", $landlord_id);
    $stmt->bindParam("tenant_id", $tenant_id);
    $stmt->bindParam("rent_start", $rent_start);
    $stmt->bindParam("rent_end", $rent_end);
    $stmt->execute();
}

// update a column
function updateColumn($pdo, $db_table, $item_id, $id_column, $update_column, $value)
{
    $query = "UPDATE $db_table SET $update_column = :value WHERE $id_column = :item_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("value", $value);
    $stmt->bindParam("item_id", $item_id);
    $stmt->execute();
}

// fetch users
function fetchUsers($pdo)
{
    $query = "SELECT * FROM users WHERE user_type = 'user';";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

// add property
function addProperty($pdo, $property_id, $images, $name, $description, $landlord_id, $price, $location_id, $address, $latitude, $longitude, $status, $type, $size, $livingroom, $bedroom, $bathroom, $property_condition, $features)
{
    $query = "INSERT INTO properties (property_id, images, name, description, landlord_id, price, location_id, address, latitude, longitude, status, type, size, livingroom, bedroom, bathroom, property_condition, features) VALUES (:property_id, :images, :name, :description, :landlord_id, :price, :location_id, :address, :latitude, :longitude, :status, :type, :size, :livingroom, :bedroom, :bathroom, :property_condition, :features);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("property_id", $property_id);
    $stmt->bindParam("images", $images);
    $stmt->bindParam("name", $name);
    $stmt->bindParam("description", $description);
    $stmt->bindParam("landlord_id", $landlord_id);
    $stmt->bindParam("price", $price);
    $stmt->bindParam("location_id", $location_id);
    $stmt->bindParam("address", $address);
    $stmt->bindParam("latitude", $latitude);
    $stmt->bindParam("longitude", $longitude);
    $stmt->bindParam("status", $status);
    $stmt->bindParam("type", $type);
    $stmt->bindParam("size", $size);
    $stmt->bindParam("livingroom", $livingroom);
    $stmt->bindParam("bedroom", $bedroom);
    $stmt->bindParam("bathroom", $bathroom);
    $stmt->bindParam("property_condition", $property_condition);
    $stmt->bindParam("features", $features);
    $stmt->execute();
}

// add property errors
function addPropertyErrors($name, $description, $landlord_id, $price, $address, $latitude, $longitude, $status, $type, $size)
{
    $errors = [];

    $name = trim($name);
    $description = trim($description);
    $address = trim($address);

    if (empty($name)) {
        $errors['name'] = "Name is required";
    }
    if (empty($description)) {
        $errors['description'] = "Description is required";
    }
    if (empty($landlord_id)) {
        $errors['landlord'] = "Landlord is required";
    }
    if (empty($price)) {
        $errors['price'] = "Price is required";
    }
    if (!empty($price) && !is_numeric($price)) {
        $errors['price'] = "Must be a number";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required";
    }
    if (!empty($latitude) && (!is_numeric($latitude) || $latitude < -90 || $latitude > 90)) {
        $errors['latitude'] = "Invalid latitude";
    }
    if (!empty($longitude) && (!is_numeric($longitude) || $longitude < -90 || $longitude > 90)) {
        $errors['longitude'] = "Invalid longitude";
    }
    if (empty($status)) {
        $errors['status'] = "Status is required";
    }
    if (empty($type)) {
        $errors['type'] = "Type is required";
    }
    if (empty($size)) {
        $errors['size'] = "Size is required";
    }
    if (!empty($size) && !is_numeric($size)) {
        $errors['size'] = "Must be a number";
    }

    return $errors;
}

// fetch landlords
function fetchLandlords($pdo)
{
    $query = "SELECT * FROM users WHERE user_type = 'landlord' OR user_type = 'admin';";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

// update blog
function updateBlog($pdo, $blog_id, $image, $title, $body)
{
    if ($image) {
        $query = "UPDATE blog SET image = :image, title = :title, body = :body WHERE blog_id = :blog_id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam("image", $image);
    } else {
        $query = "UPDATE blog SET title = :title, body = :body WHERE blog_id = :blog_id;";
        $stmt = $pdo->prepare($query);
    }
    $stmt->bindParam("blog_id", $blog_id);
    $stmt->bindParam("title", $title);
    $stmt->bindParam("body", $body);
    $stmt->execute();
}

// add blog
function addBlog($pdo, $blog_id, $image, $title, $body)
{
    $query = "INSERT INTO blog (blog_id, image, title, body) VALUES (:blog_id, :image, :title, :body);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("blog_id", $blog_id);
    $stmt->bindParam("image", $image);
    $stmt->bindParam("title", $title);
    $stmt->bindParam("body", $body);
    $stmt->execute();
}

// add blog error
function addBlogError($title, $body)
{
    $errors = [];

    if (empty($title)) {
        $errors['title'] = "Please enter title";
    }
    if (empty($body)) {
        $errors['body'] = "Please enter body";
    }

    return $errors;
}

// update name
function updateName($pdo, $user_id, $first_name, $last_name)
{
    $query = "UPDATE users SET first_name = :first_name, last_name = :last_name WHERE user_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->execute();
}

// update name error
function updateNameError($first_name, $last_name)
{
    $errors = [];

    // Trim the input to remove spaces and other invisible characters
    $first_name = trim($first_name);

    // Remove any non-printable or invisible characters
    $first_name = preg_replace('/[\x00-\x1F\x7F]/u', '', $first_name);

    // Trim the input to remove spaces and other invisible characters
    $last_name = trim($last_name);

    // Remove any non-printable or invisible characters
    $last_name = preg_replace('/[\x00-\x1F\x7F]/u', '', $last_name);

    if (empty($first_name)) {
        $errors['first_name'] = 'Please enter first name';
    }
    if (empty($last_name)) {
        $errors['last_name'] = 'Please enter last name';
    }
    if (!empty($first_name) && !preg_match('/^[a-zA-Z]+$/', $first_name)) {
        $errors['first_name'] = 'Must contain only letters';
    }
    if (!empty($last_name) && !preg_match('/^[a-zA-Z]+$/', $last_name)) {
        $errors['last_name'] = 'Must contain only letters';
    }

    return $errors;
}

// change password
function changePassword($pdo, $user_id, $password)
{
    $query = "UPDATE users SET password = :password WHERE user_id = :user_id;";
    $options = [
        "cost" => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->execute();
}

// change password errors
function changePasswordErrors($password, $confirm_password)
{
    $errors = [];

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }
    if (empty($confirm_password)) {
        $errors['confirm_password'] = 'Confirm password is required';
    }
    if (!empty($password) && strlen($password) < 6) {
        $errors['password'] = 'Password must contain 6 or more characters';
    }
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Not a match with password';
    }

    return $errors;
}

// update user type
function updateUserType($pdo, $user_id, $user_type)
{
    $query = "UPDATE users SET user_type = :user_type WHERE user_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':user_type', $user_type);
    $stmt->execute();
}

// delete item
function deleteItem($pdo, $db_table, $id_column, $item_id)
{
    $query = "DELETE FROM $db_table WHERE $id_column = :item_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
}

// taken by other
function takenByOther($pdo, $db_table, $unique_column, $value, $id_column, $item_id)
{
    $query = "SELECT * FROM $db_table WHERE $unique_column = :value AND $id_column != :item_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// taken by other
function taken($pdo, $db_table, $unique_column, $value)
{
    $query = "SELECT * FROM $db_table WHERE $unique_column = :value;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// fetch items by there id with condition
function fetchByIdWithCondition($pdo, $item_id, $db_table, $id_column, $condition_column, $condition_value)
{
    $query = "SELECT * FROM $db_table WHERE $id_column = :item_id AND $condition_column = :condition_value;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':condition_value', $condition_value);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

// fetch all items by there id with condition
function fetchAllByIdWithCondition($pdo, $item_id, $db_table, $id_column, $condition_column, $condition_value)
{
    $query = "SELECT * FROM $db_table WHERE $id_column = :item_id AND $condition_column = :condition_value;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':condition_value', $condition_value);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// fetch items by there id
function fetchById($pdo, $item_id, $db_table, $id_column)
{
    $query = "SELECT * FROM $db_table WHERE $id_column = :item_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

// check uniqueness
function isUnique($pdo, $db_table, $column, $value)
{
    $query = "SELECT * FROM $db_table WHERE $column = :value";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return false;
    } else {
        return true;
    }
}

// fetch all condition column items
function fetchAllBy($pdo, $db_table, $column, $value)
{
    $query = "SELECT * FROM $db_table WHERE $column = :value ORDER BY created_at DESC;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

// fetch all items with pagination
function fetchAllWithPagination($pdo, $db_table, $limit, $page)
{
    $offset = ((int)$page - 1) * (int)$limit;
    $query = "SELECT * FROM $db_table ORDER BY created_at DESC LIMIT :limit OFFSET :offset;";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

// fetch all items
function fetchAll($pdo, $db_table)
{
    $query = "SELECT * FROM $db_table ORDER BY created_at DESC;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

// fetch user by email
function fetchUserByEmail($pdo, $email)
{
    $query = 'SELECT * FROM users WHERE email = :email;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

// login error
function loginError($email, $password, $row)
{
    $errors = [];

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }
    if (!empty($email) && wrongEmail($row)) {
        $errors['default'] = 'Invalid Credential';
    }
    if (!empty($email) && !wrongEmail($row) && !empty($password) && wrongPassword($password, $row['password'])) {
        $errors['default'] = 'Invalid Credential';
    }

    return $errors;
}

// add user
function addUser($pdo, $user_id, $firstName, $lastName, $email, $phone, $password)
{
    $query = "INSERT INTO users (user_id, first_name, last_name, email, phone, password) VALUES (:user_id, :first_name, :last_name, :email, :phone, :password);";

    $options = [
        "cost" => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":first_name", $firstName);
    $stmt->bindParam(":last_name", $lastName);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->execute();
}

// validate user
function validateUser($pdo, $firstName, $lastName, $email, $password, $confirmPassword)
{
    $errors = [];

    // Trim the input to remove spaces and other invisible characters
    $firstName = trim($firstName);

    // Remove any non-printable or invisible characters
    $firstName = preg_replace('/[\x00-\x1F\x7F]/u', '', $firstName);

    // Trim the input to remove spaces and other invisible characters
    $lastName = trim($lastName);

    // Remove any non-printable or invisible characters
    $lastName = preg_replace('/[\x00-\x1F\x7F]/u', '', $lastName);

    if (empty($firstName)) {
        $errors['first_name'] = 'Please enter first name';
    }
    if (empty($lastName)) {
        $errors['last_name'] = 'Please enter last name';
    }
    if (empty($email)) {
        $errors['email'] = 'Please enter email';
    }
    if (empty($password)) {
        $errors['password'] = 'Please enter password';
    }
    if (empty($confirmPassword)) {
        $errors['confirm_password'] = 'Please confirm password';
    }
    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = 'Not a match with password';
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email';
    }
    if (!empty($firstName) && !preg_match('/^[a-zA-Z]+$/', $firstName)) {
        $errors['first_name'] = 'Must contain only letters';
    }
    if (!empty($lastName) && !preg_match('/^[a-zA-Z]+$/', $lastName)) {
        $errors['last_name'] = 'Must contain only letters';
    }
    if (!empty($password) && strlen($password) < 6) {
        $errors['password'] = 'Password must contain 6 or more characters';
    }
    if (emailTaken($pdo, $email)) {
        $errors['email'] = 'Email is already registered with us';
    }

    return $errors;
}

// generate unique id
function generateId($pdo, $db_table, $for)
{
    // Define the character set including special characters
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);

    do {
        // Generate a random length between the specified range
        $length = random_int(10, 15);

        // Generate the unique ID
        $unique_id = '';
        for ($i = 0; $i < $length; $i++) {
            $index = random_int(0, $charactersLength - 1);
            $unique_id .= $characters[$index];
        }

        // Check if the ID is unique in the database
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM $db_table WHERE $for = :unique_id;");
        $stmt->bindParam(':unique_id', $unique_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } while ($row['count'] > 0); // Repeat if ID is not unique

    return $unique_id;
}

// email taken
function emailTaken($pdo, $email)
{
    $query = "SELECT * FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// wrong email
function wrongEmail($result)
{
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

// wrong password
function wrongPassword($password, $hashedPassword)
{
    if (!password_verify($password, $hashedPassword)) {
        return true;
    } else {
        return false;
    }
}

function isPageActive($page)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage === $page) {
        return true;
    }
    return false;
}
