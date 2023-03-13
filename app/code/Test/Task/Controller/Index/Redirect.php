```
  <?php
  namespace Test\Task\Controller\Index;

  use Magento\Checkout\Model\Session;
  use Magento\Framework\App\Action\Action;
  use Magento\Framework\App\Action\Context;
  use Magento\Framework\App\ResponseInterface;
  use Magento\Framework\Controller\ResultFactory;

  class Redirect extends Action
  {
      /**
       * @var Session
       */
      protected $checkoutSession;

      /**
       * Redirect constructor.
       *
       * @param Context $context
       * @param Session $checkoutSession
       */
      public function __construct(
          Context $context,
          Session $checkoutSession
      ) {
          $this->checkoutSession = $checkoutSession;
          parent::__construct($context);
      }

      /**
       * Redirect to checkout.
       *
       * @return ResponseInterface
       */
      public function execute()
      {
          $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
          $resultRedirect->setUrl($this->_objectManager->get('Magento\Checkout\Helper\Cart')->getCheckoutUrl());
          return $resultRedirect;
      }
 
    }