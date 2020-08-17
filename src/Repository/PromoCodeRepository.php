<?php

namespace App\Repository;

use App\Entity\PromoCodeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromoCodeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromoCodeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromoCodeEntity[]    findAll()
 * @method PromoCodeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoCodeRepository extends ServiceEntityRepository
{
    /**
     * PromoCodeRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoCodeEntity::class);
    }

    /**
     * @param bool $alphanumeric
     * @param int $length
     * @return string
     */
    public function generateRandomCodes($alphanumeric = true, $length = 10): string
    {
        $characters = $alphanumeric ? '0123456789ABCDEFGHILKMNOPQRSTUVWXYZ' : '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param array $promoCodesArray
     */
    public function saveGeneratedCodes(array $promoCodesArray): void
    {
        file_put_contents('promoCodes.txt', implode("\n", $promoCodesArray)); //overwrite file!
    }
}
