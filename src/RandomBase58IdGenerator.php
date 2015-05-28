<?php

namespace StephenHill\ORM;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Exception;

class RandomBase58IdGenerator extends AbstractIdGenerator
{
    /**
     * Number of characters to return
     *
     * @var integer
     */
    protected $length = 16;

    /**
     * {@inheritDoc}
     */
    public function generate(EntityManager $em, $entity)
    {
        // This is to make sure we have enough input data
        $bytes = $this->length * 2;

        // Generate some random data
        $random = openssl_random_pseudo_bytes($bytes);

        // Get the Base58 encoder
        $base58 = new Base58();

        // Encode the random data
        $encoded = $base58->encode($random);

        // Truncate to the requested length
        $id = substr($encoded, 0, $this->length);

        // Check for an invalid length
        if (strlen($id) !== 16)
        {
            throw new Exception('Could not generate an ID with a valid length.');
        }

        // Return the new ID
        return $id;
    }
}