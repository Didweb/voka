<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Categories;


use App\Vokabular\Frontend\Backoffice\Application\Command\Categories\CreateCategoryCommand;
use App\Vokabular\Frontend\Backoffice\Application\Query\Categories\FindCategoryByNameQuery;
use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandBus;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateCategoryController extends AbstractController
{

    public function __construct(private CommandBus $commandBus,
                                private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): Response
    {

        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $messageType = MessageGenerator::DANGER_DUPLICATE;

            $found =  $this->queryBus->ask(new FindCategoryByNameQuery($form->getData()['name']));

            if(!$found->found()) {

                $this->commandBus->dispatch(
                new CreateCategoryCommand($form->getData()['name'])
                );
                $messageType = MessageGenerator::SUCCESS_ADD;
            }

            $this->addFlash($messageType,
                            MessageGenerator::getMessage('category',$form->getData()['name'] ,$messageType));
        }


        return $this->render('@frontend_office/categories/createCategory.html.twig', [
            'titleH1' => 'Create Category',
            'form' => $form->createView()
        ]);
    }
}