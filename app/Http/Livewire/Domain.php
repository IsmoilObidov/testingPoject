<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Iodev\Whois\Factory;
use Iodev\Whois\Exceptions\ConnectionException;
use Iodev\Whois\Exceptions\ServerMismatchException;
use Iodev\Whois\Exceptions\WhoisException;



class Domain extends Component
{

	public $domain;

	public function store(Request $request)
	{



		$whois = Factory::get()->createWhois();



		FacadesValidator::extend('domain', function ($attribute, $value, $parameters, $validator) {
			preg_match("/[^\.\/]+\.[^\.\/]+$/", $value, $matches);
			return count($matches);
		});
		FacadesValidator::extend('extension', function ($attribute, $value, $parameters, $validator) use ($whois) {
			$pathinfo = pathinfo($value);
			$extension = isset($pathinfo['extension']) ? $pathinfo['extension'] : false;
			return $whois;
		});



		//validation
		$validatedData = $this->validate([
			'domain' => 'required|min:4|domain',
		]);


		$response1 = [];

		//printing info
		// try {
		if (preg_match('/\s/', $this->domain)) {
			$response = '';
			$response = $this->domain;
			$array = explode("\n", $response);
			$i = 0;
			foreach ($array as $key) {
				$i = 1;
				$info = $whois->loadDomainInfo($key);
				if (!$info) {
					array_push(
						$response1,
						[
							'<h3 style="text-align: center">' . $key . " 🟢 свободен</h3>"
						]
					);
				} else {
					array_push(
						$response1,
						[
							'<h3 style="text-align: center">🛑Занять  <br>Срок действия ' . $key . " истекает: " . date("d.m.Y H:i:s", $info->expirationDate) . '</h3>'
						]
					);
				}
			}
			$i++;
		} else {
			$info = $whois->loadDomainInfo($this->domain);


			if (!$info) {
				array_push(
					$response1,
					[
						'<h3 style="text-align: center">' . $this->domain . " 🟢 свободен</h3>"
					]
				);
			} else {
				array_push(
					$response1,
					[
						'<h3 style="text-align: center">🛑Занять  <br>Срок действия ' . $info->domainName . " истекает: " . date("d.m.Y H:i:s", $info->expirationDate) . '</h3>'
					]
				);
			}
		}
		// 	}catch (\Throwable $th) {
		// 	dd('❌You should enter valid information about your domain!');
		// }

		$this->dispatchBrowserEvent('update', [

			'product_list' => $response1

		]);
	}



	public function render()
	{
		return view('livewire.domain');
	}
}
