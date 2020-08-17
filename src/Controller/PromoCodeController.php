<?php

namespace App\Controller;

use App\Entity\PromoCodeEntity;
use App\Form\PromoCodeType;
use App\Repository\PromoCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromoCodeController extends AbstractController
{
    /**
     * @var PromoCodeRepository
     */
    private $promoCodeRepository;

    /**
     * PromoCodeController constructor.
     * @param PromoCodeRepository $promoCodeRepository
     */
    public function __construct(PromoCodeRepository $promoCodeRepository)
    {
        $this->promoCodeRepository = $promoCodeRepository;
    }

    /**
     * @Route("/code", name="code")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $promoCode = new PromoCodeEntity();

        $form = $this->createForm(PromoCodeType::class, $promoCode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $length = $form->get('length')->getData();
            $amount = $form->get('amount')->getData();
            $alphanumeric = $form->get('type')->getData();

            $promoCodesArray = [];
            for ($i = 0; $i < $amount; $i++) {
                $promoCodesArray[] = $this->promoCodeRepository->generateRandomCodes($alphanumeric, $length);
            }

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
