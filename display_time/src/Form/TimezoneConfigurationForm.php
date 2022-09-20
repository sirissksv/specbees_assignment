<?php  
/**  
 * @file  
 * Contains Drupal\display_time\Form\TimezoneConfigurationForm.  
 */  
namespace Drupal\display_time\Form;  
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  
  
class TimezoneConfigurationForm extends ConfigFormBase {  
    /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'timezone.adminsettings',  
    ];  
  }  
  
  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'time_zone_config_form';  
  }  

  /**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  
    $config = $this->config('timezone.adminsettings');  
  
    $form['country'] = [  
      '#type' => 'textfield',  
      '#title' => $this->t('County'),  
      '#description' => $this->t('Please enter Country')
    ];  

    $form['city'] = [  
        '#type' => 'textfield',  
        '#title' => $this->t('City'),  
        '#description' => $this->t('Please enter City')
    ];  

    $form['timezone'] = [  
        '#type' => 'select',  
        '#title' => $this->t('Timezone'),  
        '#options' => [
            'America/Chicago' => t('America/Chicago'),
            'America/New_York' => t( 'America/New_York' ),
            'Asia/Tokyo' => t('Asia/Tokyo'),
            'Asia/Dubai' => t('Asia/Dubai'),
            'Asia/Kolkata' => t('Asia/Kolkata'),
            'Europe/Amsterdam' => t('Europe/Amsterdam'),
            'Europe/Oslo' => t('Europe/Oslo'),
            'Europe/London' => t('Europe/London')
        ],
        '#description' => $this->t('Please select timezone')
    ]; 
  
    return parent::buildForm($form, $form_state);  
  }  

  /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  
  
    $this->config('timezone.adminsettings')  
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();  
  }  

}  