<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\SetUp;

use App\Vokabular\Frontend\Frontoffice\Application\Query\SetUp\FindWordsFromSetupQuery;
use App\Vokabular\Frontend\Frontoffice\Infrastructure\Form\SetupType;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUpController extends AbstractController
{


    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(SetupType::class);
        $form->handleRequest($request);

        try {
            $destination = 'TRAINING';
            if ($form->isSubmitted() && $form->isValid()) {

                $category = [];
                foreach ($form->getData()['category'] as $itemCategory) {
                    $category[] = $itemCategory->id()->value();
                }

                $destination = $form->getData()['destination']??$destination;

                $query = new FindWordsFromSetupQuery(
                    $form->getData()['n_words'],
                    $form->getData()['level'],
                    $category,
                    $destination
                );

                $setUpGoalResponse = $this->queryBus->ask($query);

                return $this->render($setUpGoalResponse->pathToTemplate(), [
                    'goal' => $setUpGoalResponse->toArray()
                ]);

            }


        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}