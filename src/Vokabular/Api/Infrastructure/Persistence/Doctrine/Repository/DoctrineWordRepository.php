<?php

namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Repository;

use App\Vokabular\Api\Application\Response\Words\WordCollectionResponse;
use App\Vokabular\Api\Application\Response\Words\WordResponse;
use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Domain\Model\Words\WordRepository;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Api\Domain\Service\Pagination;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ObjectRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;

class DoctrineWordRepository implements WordRepository
{

    private EntityManagerInterface $em;
    private ObjectRepository $repository;
    private PaginatorInterface $paginator;

    public function __construct(EntityManagerInterface $em, PaginatorInterface $paginator)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Word::class);
        $this->paginator = $paginator;
    }




    public function insert(Word $word): void
    {
        $wordFindByName = $this->repository->findBy(['word' => $word->word()]);

        if ($wordFindByName) {
            throw new Exception('Duplicate word: '.$word->word());
        }

        $word =  new Word(
            $word->id(),
            $word->word(),
            $word->image(),
            $word->gender(),
            $word->level(),
            null,
            null,
            null
        );
        $this->em->persist($word);
        $this->em->flush();



    }


    public function updateWordComplete(Word $word): void
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->update(Word::class, 'w')
            ->set('w.word', ':word')
            ->set('w.gender', ':gender')
            ->set('w.level', ':level')
            ->set('w.category', ':category')
            ->set('w.updatedAt', ':updatedAt')
            ->where('w.id = :id')
            ->setParameter('word', $word->word())
            ->setParameter('gender', $word->gender())
            ->setParameter('level', $word->level())
            ->setParameter('category', $word->category())
            ->setParameter('updatedAt', new \DateTime())
            ->setParameter('id', $word->id())
            ->getQuery();

        $query->execute();
    }



    public function updateWord(Word $word): void
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->update(Word::class, 'w')
            ->set('w.category', ':category')
            ->set('w.updatedAt', ':updatedAt')
            ->where('w.id = :id')
            ->setParameter('category', $word->category())
            ->setParameter('updatedAt', new \DateTime())
            ->setParameter('id', $word->id())
            ->getQuery();

        $query->execute();
    }

    private function getWordCollectionResponse($wordFind, ?Pagination $pagination = null): WordCollectionResponse
    {

        $wordCollection = WordsCollection::init();

        if(!empty($wordFind)) {
            foreach ($wordFind as $word) {
                $wordDomain = Word::fromInfrastructure($word);

                $wordResponse = new WordResponse($wordDomain);
                $wordCollection->add($wordResponse);
            }
        }
        return new WordCollectionResponse($wordCollection, $pagination);
    }




    public function findAll(Pagination $pagination): WordCollectionResponse
    {
        $query = $this->repository->createQueryBuilder('w')
            ->orderBy('w.word', 'ASC')
            ->getQuery();

        $paginator = new Paginator($query);

        $paginator->getQuery()
            ->setFirstResult($pagination->offset()) // Offset
            ->setMaxResults($pagination->limit()); // Limit

        $pagination->updateTotals($paginator->count());

       return $this->getWordCollectionResponse($paginator, $pagination);
    }

    public function delete(string $id): void
    {
        $word = $this->em->getRepository(Word::class)->find(['id'=>$id]);

        if (!$word) {
            throw new Exception('No word found for id '.$id);
        }


        $this->em->remove($word);
        $this->em->flush();
    }

    public function updateImage(Word $word): void
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->update(Word::class, 'w')
            ->set('w.image', ':image')
            ->set('w.updatedAt', ':updatedAt')
            ->where('w.id = :id')
            ->setParameter('updatedAt', new \DateTime())
            ->setParameter('id', $word->id())
            ->setParameter('image', $word->image())
            ->getQuery();

        $query->execute();
    }

    public function findWordsFromSetup($setUp): WordCollectionResponse
    {

        $criteria = array_rand([
                'w.word' => 'xx',
                'w.id' => 'xx',
                'w.createdAt' => 'xx']);

        $orderBy = array_rand([
                'DESC' => 'DESC',
                'ASC' => 'ASC'
                ]);

        $query = $this
            ->repository
            ->createQueryBuilder('w');

        if($setUp->level() !== null) {
            $query->andWhere('w.level IN (:levels)')
                ->setParameter('levels', $setUp->level());
        }
        if($setUp->category() !== null) {
            $query-> andWhere('w.category IN (:category)')
                ->setParameter('category', $setUp->category());
        }


        $query->orderBy($criteria, $orderBy);
        $query->setMaxResults($setUp->n_words());

        $wordsFind =  $query->getQuery()->execute();

        return $this->getWordCollectionResponse($wordsFind);
    }

    public function findStatsBackoffice(): array
    {
        $queryCountDer = $this->repository->createQueryBuilder('w')
            ->select('count(w.word) as total_der')
            ->where('w.gender = :der')
            ->setParameter('der','der')
            ->getQuery()->execute();

        $queryCountDie = $this->repository->createQueryBuilder('w')
            ->select('count(w.word) as total_die')
            ->where('w.gender = :die')
            ->setParameter('die','die')
            ->getQuery()->execute();

        $queryCountDas = $this->repository->createQueryBuilder('w')
            ->select('count(w.word) as total_das')
            ->where('w.gender = :das')
            ->setParameter('das','das')
            ->getQuery()->execute();


        return [
            'total_der'=> $queryCountDer[0]['total_der'],
            'total_die'=> $queryCountDie[0]['total_die'],
            'total_das'=> $queryCountDas[0]['total_das']
        ];
    }
}