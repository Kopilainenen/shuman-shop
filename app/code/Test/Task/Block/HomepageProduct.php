
  <?php
  //
  namespace Test\Task\Block;

  use Magento\Catalog\Api\Data\ProductInterface;
  use Magento\Catalog\Api\ProductRepositoryInterface;
  use Magento\Framework\View\Element\Template;

  class HomepageProduct extends Template
  {
      /**
       * @var ProductRepositoryInterface
       */
      protected $productRepository;

      /**
       * HomepageProduct constructor.
       *
       * @param Template\Context $context
       * @param ProductRepositoryInterface $productRepository
       * @param array $data
       */
      public function __construct(
          Template\Context $context,
          ProductRepositoryInterface $productRepository,
          array $data = []
      ) {
          $this->productRepository = $productRepository;
          parent::__construct($context, $data);
      }

      /**
       * Get a random product.
       *
       * @return ProductInterface
       */
      public function getRandomProduct()
      {
          $searchCriteriaBuilder = $this->productRepository->createSearchCriteriaBuilder();
          $searchCriteriaBuilder->addFilter('status', 1);
          $searchCriteriaBuilder->addFilter('visibility', 4);
          $searchCriteriaBuilder->setPageSize(1);
          $searchCriteriaBuilder->setCurPage(rand(1, $this->productRepository->getList($searchCriteriaBuilder->create())->getTotalCount()));

          $products = $this->productRepository->getList($searchCriteriaBuilder->create());

          return $products->getItems()[0];
      }

      /**
       * Get the title of the block/area.
       *
       * @return string
       */
      public function getTitle()
      {
          $title = $this->_scopeConfig->getValue('test_task/general/block_area_title', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
          if (!$title) {
              $title = __('Random Product');
          }
          return $title;
      }

      /**
       * Get the "Buy" button URL.
       *
       * @param ProductInterface $product
       * @return string
       */
      public function getAddToCartUrl($product)
      {
          if ($this->_scopeConfig->getValue('test_task/general/redirect_to'));
      }
    }