<?php

/**
 * This is the Data transfert object for Jsonreponse
 *
 * @category DTO
 * @package  DTO
 * @author   David LE PENVEN <david.lepenven@ozitem.com>
 * @license  https://ozitem.com/ Ozitem 2022
 * @link     https://ozitem.com
 */

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
// use Swagger\Annotations as SWG;
use OpenApi\Annotations as OA;

 /**
  * This is the Data transfert object for Jsonreponse
  *
  * @category DTO
  * @package  DTO
  * @author   David LE PENVEN <david.lepenven@ozitem.com>
  * @license  https://ozitem.com/ Ozitem 2022
  * @link     https://ozitem.com
  */
class JsonResponseDTO
{
    /**
     * Constructor
     *
     * @param string $code    The code
     * @param string $message The message
     * @param array<mixed>  $data    The data
     *
     * @return void
     */
    public function __construct(private string $code, private string $message, private array $data)
    {
    }

    /**
     * This function is called to get an array representation of the obj
     *
     * @return array<mixed>
     */
    public function toArray()
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}
