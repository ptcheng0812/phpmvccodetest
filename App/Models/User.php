<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Error messages
     *
     * @var array
     */
    public $errors = [];

    /**
   * Class constructor
   *
   * @param array $data  Initial property values
   *
   * @return void
   */
  public function __construct($data = [])
  {
    foreach ($data as $key => $value) {
      $this->$key = $value;
    };
  }

  /**
   *
   *
   * @return void
   */
  public function save()
  {

    $sql = 'INSERT INTO users (name, email, school)
            VALUES (:name, :email, :school)';

    $db = static::getDB();
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
    $stmt->bindValue(':school', $this->school, PDO::PARAM_STR);

    $stmt->execute();
  }

  // /**
  //    * Validate current property values, adding valiation error messages to the errors array property
  //    *
  //    * @return void
  //    */
  //   public function validate()
  //   {
  //      // Name
  //     if ($this->name == '') {
  //         $this->errors[] = 'Name is required';
  //     }

  //      // email address
  //     if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
  //         $this->errors[] = 'Invalid email';
  //     }

  //     // Password
  //     if ($this->password != $this->password_confirmation) {
  //         $this->errors[] = 'Password must match confirmation';
  //     }

  //     if (strlen($this->password) < 6) {
  //         $this->errors[] = 'Please enter at least 6 characters for the password';
  //     }

  //     if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
  //         $this->errors[] = 'Password needs at least one letter';
  //     }

  //     if (preg_match('/.*\d+.*/i', $this->password) == 0) {
  //         $this->errors[] = 'Password needs at least one number';
  //     }
  //   }

    /**
     *
     *
     * @param string
     *
     * @return boolean
     */
    public static function emailExists($school)
    {
        return static::findBySchool($school) !== false;
    }

    /**
     *
     *
     * @param string
     *
     * @return mixed
     */
    public static function findBySchool($school)
    {
        $sql = 'SELECT * FROM users WHERE school = :school';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':school', $school, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_NUM);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
