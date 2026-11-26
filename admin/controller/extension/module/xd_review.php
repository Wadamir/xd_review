<?php
class ControllerExtensionModuleXdReview extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/xd_review');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_xd_review', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/xd_review', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/xd_review', 'user_token=' . $this->session->data['user_token'], true);
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		$data['user_token'] = $this->session->data['user_token'];

		$fields = array('status', 'moderation', 'guest', 'min_length');
		foreach ($fields as $field) {
			$key = 'module_xd_review_' . $field;
			if (isset($this->request->post[$key])) {
				$data[$key] = $this->request->post[$key];
			} else {
				$value = $this->config->get($key);
				$data[$key] = ($value === null) ? ($field == 'min_length' ? 10 : ($field == 'status' || $field == 'moderation' ? 1 : 0)) : $value;
			}
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/xd_review', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/xd_review')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$min_length = isset($this->request->post['module_xd_review_min_length']) ? (int)$this->request->post['module_xd_review_min_length'] : 0;
		if ($min_length < 1 || $min_length > 1000) {
			$this->error['warning'] = $this->language->get('error_min_length');
		}

		return !$this->error;
	}
}
