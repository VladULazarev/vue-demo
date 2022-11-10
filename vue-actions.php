<?php if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
/**
 * We need the above code to allow the access to this file
 */

use PDO;

/**
 * Connect to DB --------------------------------------------------------------
 */
class DbConnection
{
    public function connect()
    {
        try {
            $handler = new PDO('mysql:host=localhost;charset=utf8mb4;dbname=db_name', 'user_name', 'password');
          	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          	//echo $e->getMessage(); // for debugging
          	die("<h1>Sorry, db problema.</h1>
                <p>It could be a wrong 'database name'.</p>
                <p>It could be a wrong 'login'.</p>
                <p>It could be a wrong 'password'.</p>
                ");
        }

        return $handler;
    }
}

/**
 * Model ---------------------------------------------------------------------
 */
class Model extends DbConnection
{
    /**
     * Get all records from the current table
     */
    public function index($tableName)
    {
        $query = $this->connect()->prepare("SELECT * FROM $tableName ORDER BY id DESC");

        $query->execute([]);

        return $query;
    }

    /**
     * Get one record
     */
    public function getOneRecord($tableName, $id)
    {
        $query = $this->connect()->prepare("SELECT * FROM $tableName WHERE id = ?");

        $query->execute([$id]);

        return $query;
    }

    /**
     * Get all posts by the current page
     */
    public function indexPosts($tableName, $page, $limit)
    {
        $query = $this->connect()->prepare("SELECT * FROM $tableName  LIMIT $limit OFFSET $page");

        $query->execute([]);

        return $query;
    }

    /**
     * Save a new messsage
     */
    public function save($name, $email, $subject, $message, $contact_ip)
    {

        $pre_insert = "INSERT INTO contact (

            name,
            email,
            subject,
            message,
            contact_ip

        ) VALUES (?, ?, ?, ?, ?)";

        $insert = $this->connect()->prepare($pre_insert);

        if ( $insert->execute([

              $name,
              $email,
              $subject,
              $message,
              $contact_ip

             ])
        ) {
            return TRUE;
        }
    }

    /**
     * Update a messsage
     */
    public function updateMessage($id, $name, $email, $subject, $message, $contact_ip)
    {

        $pre_update = "UPDATE contact
        SET name = ?, email = ?, subject = ?, message = ?, contact_ip = ? WHERE id = ?";

        $update = $this->connect()->prepare($pre_update);

        if ( $update->execute([

              $name,
              $email,
              $subject,
              $message,
              $contact_ip,
              $id

             ])
        ) {
            return TRUE;
        }
    }


    /**
     * Delete a record from the current table
     */
    public function destroy(string $tableName, $id)
    {
        $pre_destroy = "DELETE FROM $tableName WHERE id = ?";

        $destroy = $this->connect()->prepare($pre_destroy);

        $destroy->execute([$id]);
    }

    /**
     * Get user's IP
     */
    public function getUsersIp(): string
    {
        if (! empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}



/**
 * Handle the requests from 'Vue' ------------------------------------------------
 */

$received_data = json_decode(file_get_contents("php://input"));

$data = [];

/**
 * Save a new messsage
 */
if ($received_data->action == 'saveMessage')
{
    $save = new Model();

    $name       = htmlentities($received_data->name);
    $email      = htmlentities($received_data->email);
    $subject    = htmlentities($received_data->subject);
    $message    = htmlentities($received_data->message);
    $contact_ip = $save->getUsersIp();

    $save->save($name, $email, $subject, $message, $contact_ip);

    $output = array(
        'msg' => 'Data Saved'
    );

    echo json_encode($output);
}

/**
 * Get all records from the current table
 */
else if ($received_data->action == 'fetchall')
{
    $tableName = $received_data->tableName;

    $query = new Model();
    $getData = $query->index($tableName);

    while($row = $getData->fetch(PDO::FETCH_ASSOC))
    {
      $data[] = $row;
    }

    echo json_encode($data);
}

/**
 * Delete a record from the current table
 */
else if ($received_data->action == 'delete')
{
    $id        = $received_data->id;
    $tableName = $received_data->tableName;

    $delete = new Model();
    $destroy = $delete->destroy($tableName, $id);


    $output = array(
        'msg' => 'Data Deleted'
    );

    echo json_encode($output);
}

/**
 * Get posts by the current page
 */
else if ($received_data->action == 'fetchposts')
{
    $tableName = $received_data->tableName;
    $page = $received_data->page;
    $limit = $received_data->limit;

    $query = new Model();
    $getData = $query->indexPosts($tableName, $page, $limit);

    while($row = $getData->fetch(PDO::FETCH_ASSOC))
    {
      $data[] = $row;
    }

    echo json_encode($data);
}

/**
 * Get one record
 */
else if ($received_data->action == 'getonerecord')
{
    $tableName = $received_data->tableName;
    $id = $received_data->id;

    $query = new Model();
    $getData = $query->getOneRecord($tableName, $id);

    $data = $getData->fetch(PDO::FETCH_ASSOC);

    echo json_encode($data);
}

/**
 * Update a record
 */
else if ($received_data->action == 'updateMessage')
{
    $save = new Model();

    $id       = htmlentities($received_data->id);
    $name     = htmlentities($received_data->name);
    $email    = htmlentities($received_data->email);
    $subject  = htmlentities($received_data->subject);
    $message  = htmlentities($received_data->message);
    $contact_ip = $save->getUsersIp();

    $save = new Model();
    $save->updateMessage($id, $name, $email, $subject, $message, $contact_ip);

    $output = array(
        'msg' => 'Data updated'
    );

    echo json_encode($output);
}
