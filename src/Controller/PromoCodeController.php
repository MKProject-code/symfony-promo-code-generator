<?php

namespace App\Controller;

use App\Entity\PromoCode;
use App\Form\PromoCodeType;
use App\Repository\PromoCodeRepository;
use App\Service\PromoCodeGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromoCodeController extends AbstractController
{
    /**
     * @var PromoCodeGenerator
     */
    private $promoCodeGenerator;
    /**
     * @var PromoCodeRepository
     */
    private $promoCodeRepository;

    /**
     * PromoCodeController constructor.
     * @param PromoCodeGenerator $promoCodeGenerator
     */
    public function __construct(PromoCodeGenerator $promoCodeGenerator, PromoCodeRepository $promoCodeRepository)
    {
        $this->promoCodeGenerator = $promoCodeGenerator;
        $this->promoCodeRepository = $promoCodeRepository;
    }

    /**
     * @Route("/code", name="code")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $promoCode = new PromoCode();

        $form = $this->createForm(PromoCodeType::class, $promoCode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $length = $form->get('length')->getData();
            $amount = $form->get('amount')->getData();
            $alphanumeric = $form->get('type')->getData();

            $promoCodesArray = $this->promoCodeGenerator->generateRandomCodes($alphanumeric, $length, $amount);

            $promoCodeEntities = [];
            foreach($promoCodesArray as $code) {
                $promoCodeEntity = new PromoCode();
                $promoCodeEntity->setCode($code);
                $promoCodeEntities[] = $promoCodeEntity;
            }
            
            $this->promoCodeRepository->save($promoCodeEntities);

            return $this->render('code/index.html.twig', [
                'form' => $form->createView(),
                'promoCodes' => $promoCodesArray,
            ]);
        }

        return $this->render('code/index.html.twig', [
            'form' => $form->createView(),
            'promoCodes' => [],
        ]);
    }
}
