<?php

namespace Drupal\news\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Pager\PagerManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Datetime\DrupalDateTime;

class NewsController extends ControllerBase
{
    /**
     * The pager manager.
     *
     * @var \Drupal\Core\Pager\PagerManagerInterface
     */
    protected $pagerManager;

    /**
     * Constructs a NewsController object.
     *
     * @param \Drupal\Core\Pager\PagerManagerInterface $pager_manager
     *   The pager manager service.
     */
    public function __construct(PagerManagerInterface $pager_manager) {
        $this->pagerManager = $pager_manager;
    }

    /**
     * Displays a listing of news articles.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The current request.
     *
     * @return array
     *   A render array.
     * @throws \Exception
     */
    public function listing(Request $request)
    {

//        if (\Drupal::currentUser()->hasPermission('administer nodes')) {
//            $this->randomizeActualiteDates();
//        }

        $limit = 10;

        $today = new DrupalDateTime('today');
        $today_formatted = $today->format('Y-m-d');

        $query = \Drupal::entityTypeManager()->getStorage('node')->getQuery()
            ->accessCheck(TRUE)
            ->condition('type', 'actualite')
            ->condition('status', 1)
            ->condition('field_date', $today_formatted, '>=')
            ->sort('field_date', 'ASC');

        $query->pager($limit);

        $nids = $query->execute();
        $nodes = Node::loadMultiple($nids);

        $build = [
            'items_wrapper' => [
                '#prefix' => '<div class="news-listing">',
                '#suffix' => '</div>',
                'items' => [],
            ],
            'pager' => [
                '#type' => 'pager',
            ],
        ];
        
        if (empty($nodes)) {
            $build['no_results'] = [
                '#markup' => $this->t('No news articles available.'),
            ];
            return $build;
        }

        foreach ($nodes as $node) {
            $build['items_wrapper']['items'][] = [
                '#theme' => 'news_teaser',
                '#node' => $node,
            ];
        }

        $build['pager'] = [
            '#type' => 'pager',
        ];

        return $build;
    }

    /**
     * Randomly updates the dates of published news articles
     * within a period of 0 to 30 days from today.
     *
     * @return void
     * @throws \Exception
     * This method updates the 'field_date' of each published 'actualite' node
     * to a random date within the next 30 days.
     *
     * @throws \Exception
     * This method will throw an exception if there is an issue with date formatting or saving the node.
     */
    public function randomizeActualiteDates(): void
    {
        $nids = \Drupal::entityTypeManager()
            ->getStorage('node')
            ->getQuery()
            ->accessCheck(TRUE)
            ->condition('type', 'actualite')
            ->condition('status', 1)
            ->execute();

        $nodes = Node::loadMultiple($nids);

        foreach ($nodes as $node) {
            if ($node instanceof NodeInterface && $node->hasField('field_date')) {

                $daysToAdd = random_int(0, 30);

                $randomDate = new DrupalDateTime('+' . $daysToAdd . ' days');

                $formattedDate = $randomDate->format('Y-m-d');

                $node->set('field_date', $formattedDate);
                $node->save();

                \Drupal::logger('news')->notice("Actualité {$node->id()} mise à jour avec la date {$formattedDate}");
            }
        }
    }

}
