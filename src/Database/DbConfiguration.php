<?php 

namespace App\Database;


class DbConfiguration
{
    /**
     * Driver 
     * 
     * @var string $_driver
     */
    private ?string $_driver;
    /**
     * Hostname
     * 
     * @var string $_host
     */
    private ?string $_host;
     /**
      * Port
      * 
      * @var int $_host
      */
    private ?int $_port;
    /**
     * Username
     * 
     * @var string $_username
     */
    private ?string $_username;
    /**
     * Username
     * 
     * @var string $_password
     */
    private ?string $_password;
    /**
     * Database
     * 
     * @var string $_database
     */
    private ?string $_database;
    /**
     * Charset
     * 
     * @var string $_charset
     */
    private ?string $_charset;
    /**
     * Construct
     * 
     * @param string $driver   - 
     * @param string $host     -
     * @param int    $port     -
     * @param string $username -
     * @param string $password - 
     * @param string $database -
     * @param string $charset  -
     */
    public function __construct(
        string $driver, string $host, int $port, 
        string $username, string $password,
        string $database, string $charset ="utf8"
    ) {
        $this->_driver   = $driver;
        $this->_host     = $host;
        $this->_port     = $port;
        $this->_username = $username;
        $this->_password = $password;
        $this->_database = $database;
        $this->_charset  = $charset;
    }

    /**
     * Get $_drive
     *
     * @return string
     */ 
    public function getDriver(): ?string
    {
        return $this->_driver;
    }

    /**
     * Set $_drive
     *
     * @param string $driver - 
     *
     * @return DbConfiguration
     */ 
    public function setDriver(string $driver)
    {
        $this->_driver = $driver;

        return $this;
    }

    /**
     * Get $_host
     *
     * @return string
     */ 
    public function getHost(): ?string
    {
        return $this->_host;
    }

    /**
     * Set $_host
     *
     * @param string $host -
     *
     * @return DbConfiguration
     */ 
    public function setHost(string $host): DbConfiguration
    {
        $this->_host = $host;

        return $this;
    }

    /**
     * Get $_host
     *
     * @return int
     */ 
    public function getPort(): ?int
    {
        return $this->_port;
    }

    /**
     * Set $_host
     *
     * @param int $port -
     *
     * @return DbConfiguration
     */ 
    public function setPort(int $port): DbConfiguration
    {
        $this->_port = $port;

        return $this;
    }

    /**
     * Get $_username
     *
     * @return string
     */ 
    public function getUsername(): ?string
    {
        return $this->_username;
    }

    /**
     * Set $_username
     *
     * @param string $username -
     *
     * @return DbConfiguration
     */ 
    public function setUsername(string $username): DbConfiguration
    {
        $this->_username = $username;

        return $this;
    }

    /**
     * Get $_password
     *
     * @return string
     */ 
    public function getPassword(): ?string
    {
        return $this->_password;
    }

    /**
     * Set $_password
     *
     * @param string $password -
     *
     * @return DbConfiguration
     */ 
    public function setPassword(string $password): DbConfiguration
    {
        $this->_password = $password;

        return $this;
    }

    /**
     * Get $_database
     *
     * @return string
     */ 
    public function getDatabase(): ?string
    {
        return $this->_database;
    }

    /**
     * Set $_database
     *
     * @param string $database - 
     *
     * @return DbConfiguration
     */ 
    public function setDatabase(string $database): DbConfiguration
    {
        $this->_database = $database;

        return $this;
    }

    /**
     * Get $_charset
     *
     * @return string
     */ 
    public function getCharset(): ?string
    {
        return $this->_charset;
    }

    /**
     * Set $_charset
     *
     * @param string $charset - 
     *
     * @return DbConfiguration
     */ 
    public function setCharset(string $charset): DbConfiguration
    {
        $this->_charset = $charset;

        return $this;
    }
}
