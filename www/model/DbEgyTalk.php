<?php
class DbEgyTalk
{
    private $db;
    /**
     * Anluter till databasen och returnerar ett PDO-objekt
     * @return PDO  Objektet som returneras
     */
    public function __construct()
    {
        // Definierar konstanter med användarinformation.
        define('DB_USER', 'egytalk');
        define('DB_PASSWORD', '12345');
        define('DB_HOST', 'mariadb'); // mariadb om docker annars localhost
        define('DB_NAME', 'egytalk');

        // Skapar en anslutning till MySql och databasen egytalk
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        $this->db = new PDO($dsn, DB_USER, DB_PASSWORD);
    }

    function logIn($userName, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :user");
        $stmt->bindValue(":user", $userName);

        $stmt->execute();
        $response = [];
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $response['uid'] = true;

                $response['uid'] = $user['uid'];
                $response['username'] = $user['username'];

                $response['name'] = $user['firstname'] . " " . $user['surname'];

                return $response;
            } else {
                return $response;
            }
        } else {
            return $response;
        }
    }

    function signUp($firstName, $surName, $userName, $password)
    {
        $result = true;
        $sqlkod = "INSERT INTO user(uid, firstname, surname, username, password) VALUES(UUID(), :fn, :sn,:user,:pwd)";

        $stmt = $this->db->prepare($sqlkod);

        $stmt->bindValue(":fn", $firstName, PDO::PARAM_STR);
        $stmt->bindValue(":sn", $surName, PDO::PARAM_STR);
        $stmt->bindValue(":user", $userName, PDO::PARAM_STR);
        $stmt->bindValue(":pwd", $password, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return $result;
        } catch (Exception $e) {
            $result = !$result;
            return $result;
        }
    }

    function searchFriend($userName)
    {
        $sqlkod = "SELECT firstname, surname, username, `uid` FROM user WHERE username LIKE :username AND uid NOT LIKE :uid";

        $stmt = $this->db->prepare($sqlkod);
        $stmt->bindValue(':username', $userName . "%");
        $stmt->bindValue(':uid', $_SESSION['uid']);

        $stmt->execute();

        $_SESSION['count'] = $stmt->rowCount();

        $friends = [];

        if ($stmt->rowCount() > 0) {
            $friends = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $friends;
        } else {
            return $friends;
        }
    }

    function selectPostsFromUser()
    {
        $sqlkod = "SELECT post.* , user.firstname, user.surname, user.username FROM post NATURAL JOIN user WHERE user.uid = :uid ORDER BY date DESC";

        $stmt = $this->db->prepare($sqlkod);
        $stmt->bindValue(':uid', $_SESSION['uid']);

        $stmt->execute();
        $posts = [];
        if ($stmt->rowCount() > 0) {
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $posts;
        } else {
            return $posts;
        }
    }

    function selectPostsFromAll()
    {
        $sqlkod = "SELECT post.* , user.firstname, user.surname, user.username FROM post NATURAL JOIN user ORDER BY date DESC";
        $stmt = $this->db->prepare($sqlkod);
        $stmt->execute();

        $posts = [];
        if ($stmt->rowCount() > 0) {
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $posts;
        } else {
            return $posts;
        }
    }

    function selectFriends()
    {
        $sql = "SELECT friend.* , user.firstname, user.surname, user.username FROM `friend` JOIN `user` ON friend.uid2 = user.uid WHERE friend.uid = :uid AND user.uid != :uid ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':uid', $_SESSION['uid']);
        $stmt->execute();

        $friends = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $friends;
    }

    function insertFriend($post)
    {
        $stmt = $this->db->prepare("INSERT INTO friend (firstname, surname, username, uid, uid2) VALUES (:firstname, :surname, :username, :uid, :uid2)");

        $stmt->bindValue(':uid', $_SESSION['uid']);
        $stmt->bindValue(':uid2', $post['uid2']);
        $stmt->bindValue(":firstname", $post['firstName']);
        $stmt->bindValue(":surname", $post['surName']);
        $stmt->bindValue(":username", $post['userName']);

        $stmt->execute();
    }

    function checkFriend($friend)
    {
        $check = true;
        $stmt = $this->db->prepare("SELECT 1 FROM friend WHERE uid = :uid AND uid2 = :uid2");

        $stmt->bindValue(':uid', $_SESSION['uid']);
        $stmt->bindValue(':uid2', $friend['uid2']);

        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return $check;
        } else {
            $check = !$check;
            return $check;
        }
    }

    function saveMsg($msg)
    {
        $stmt = $this->db->prepare("INSERT INTO comment(pid, comment_txt, date, uid) VALUES (:pid, :comment_txt, :date, :uid)");
        $stmt->bindValue(":uid", $_SESSION['uid']);
        $stmt->bindValue(":comment_txt", $msg);
        $stmt->bindValue(":date", date("Y-m-d H:i:s"));
        $stmt->bindValue(":pid", $_POST['pid']);

        $stmt->execute();
    }

    function checkToDeleteUser($userName, $password)
    {
        $stmt = $this->db->prepare("SELECT password FROM user WHERE uid = :uid");
        $stmt->bindValue(':uid', $_SESSION['uid']);
        $stmt->execute();

        $deleteCheck = [];
        if ($stmt->rowCount() === 1) {
            $deleteCheck = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($_SESSION['username'] == $userName) {
                if (password_verify($password, $deleteCheck['password'])) {
                    return $deleteCheck;
                } else {
                    $deleteCheck = [];
                    return $deleteCheck;
                }
            } else {
                $deleteCheck = [];
                return $deleteCheck;
            }
        } else {
            return $deleteCheck;
        }
    }

    function deleteUser()
    {
        $stmt = $this->db->prepare("DELETE user, comment, friend FROM user LEFT JOIN comment ON user.uid = comment.uid LEFT JOIN friend ON user.uid = friend.uid WHERE user.uid = :uid");
        $stmt->bindValue(':uid', $_SESSION['uid']);
        $stmt->execute();
    }

    function selectAllMessages($postPid)
    {
        $stmt = $this->db->prepare("SELECT comment.*, user.firstname, user.surname, user.username FROM comment JOIN user ON comment.uid = user.uid WHERE comment.pid = :pid ORDER BY date ASC");
        $stmt->bindValue(':pid', $postPid);

        $stmt->execute();
        $comments = [];

        if ($stmt->rowCount() > 0) {
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $comments;
        } else {
            return $comments;
        }
    }

    function saveKlotterMessages($klotter)
    {
        $stmt = $this->db->prepare("INSERT INTO post(uid, post_txt, date) VALUES (:uid , :post_txt, :date)");

        $stmt->bindValue(":uid", $_SESSION['uid']);
        $stmt->bindValue(":post_txt", $klotter);
        $stmt->bindValue(":date", date("Y-m-d H:i:s"));

        $stmt->execute();
    }

    function deleteFriend($friend)
    {
        $sql = "DELETE friend.* FROM `friend` WHERE friend.uid = :uid AND friend.uid2 = :uid2 ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':uid', $_SESSION['uid']);
        $stmt->bindValue(':uid2', $friend['friendUid']);
        $stmt->execute();
    }
}