<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config as FacadesConfig;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Iodev\Whois\Factory;
use Iodev\Whois\Exceptions\ConnectionException;
use Iodev\Whois\Exceptions\ServerMismatchException;
use Iodev\Whois\Exceptions\WhoisException;


class WhoisLookupController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
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
			return  $whois;
		});

		$input = $request->all();

		//validation
		$validator = FacadesValidator::make($input, [
			'domain' => 'required|min:4|domain|extension',
		]);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return \Illuminate\Http\Response::json($validator->messages, 400);
			} else {
				return redirect('/')
					->withErrors($validator)
					->withInput();
			}
		}




		// name input in blade
		$domain = $request->get('domain');

		
		//printing info
		try {
			$info = $whois->loadDomainInfo($domain);
			if (!$info) {
				print "<h3 style='text-align: center'>" . $domain . " 🟢 свободен<h3>";
				exit;
			}
			print '<h3 style="text-align: center">🛑Занять  <br>Срок действия '.$info->domainName . " истекает: " . date("d.m.Y H:i:s", $info->expirationDate) . '<h3>';
		} catch (ConnectionException $e) {
			print "Время ожидания отключения или подключения";
		} catch (ServerMismatchException $e) {
			print "Сервер TLD (.com для google.com) не найден на текущих серверах";
		} catch (WhoisException $e) {
			print "Сервер Whois ответил с ошибкой '{$e->getMessage()}'";
		}
	}
}
