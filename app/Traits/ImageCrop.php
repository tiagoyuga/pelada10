<?php
/**
 * Created by PhpStorm.
 * User: rupertlustosa
 * Date: 15/08/17
 * Time: 21:10
 */

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageCrop
{

    public function imageCrop($id, $ordemImagem = null)
    {
        $this->log(__METHOD__);
        $route = route($this->cropModule . '.updateImageCrop', [$id]);

        $item = $this->service->find($id);
        $image = $item->{'image' . $ordemImagem};

        $config = config('upload.' . $this->cropModule);

        if ($config['width'] === $config['height']) {

            $aspectRatio = '1/1';
        } elseif ($config['width'] >= $config['height']) {

            $aspectRatio = round($config['width'] / $config['height'], 2) . '/1';
        } elseif ($config['width'] <= $config['height']) {

            $aspectRatio = '1/' . round($config['height'] / $config['width'], 2);
        }
        $label = 'Ajuste o posicionamento da imagem';
        return view('panel._layouts.image-crop', compact('image', 'ordemImagem', 'aspectRatio', 'label'))
            ->with('cropModule', $this->cropModule)
            ->with('url', $route);
    }

    public function updateImageCrop(Request $request)
    {

        $this->log(__METHOD__);

        $pasta = config('upload.' . $this->cropModule . '.pastaUploadImages');

        $caminho_imagem = $request['image'];
        $caminho_imagem_original = 'images/' . str_replace($pasta, $pasta . '/Original', $caminho_imagem);

        if (Storage::exists($caminho_imagem_original)) {
            // open file a image resource
            $file = Storage::get($caminho_imagem_original);
            $img = Image::make($file);

            $proporcao = $img->width() / config('upload.tamanhoExibicaoDoCrop');

            // crop image
            $dataWidth = round($request->dataWidth * $proporcao);
            $dataHeight = round($request->dataHeight * $proporcao);
            $dataX = round($request->dataX * $proporcao);
            $dataY = round($request->dataY * $proporcao);

            $img->crop($dataWidth, $dataHeight, $dataX, $dataY);

            $img->resize(config('upload.' . $this->cropModule . '.width'), config('upload.' . $this->cropModule . '.height'), function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $payload = (string)$img->encode();
            Storage::put(
                'images/' . $caminho_imagem,
                $payload
            );

        } else {

            throw new \Exception('FILE_NOT_EXISTS: ' . $caminho_imagem_original);
        }

        $url = \Config::get('upload.' . $this->cropModule . '.urlRedirecionamentoAposCrop');

        if (request('iframe')) {
            $url = route('iframe').'?iframe=true&table_id=1&table_reference=images&table_text_data=images';
        }

        return redirect()->to($url)
            ->with('message', 'Imagem atualizada com sucesso!')
            ->with('messageType', 's');
    }

    public function imageCropOtherImageSameController($id, $attr_name, $config_module)
    {
        $this->log(__METHOD__);
        $route = route($this->cropModule . '.updateImageCrop', [$id]);
        $item = $this->service->find($id);
        $image = $item->{$attr_name};

        $config = config('upload.' . $config_module);

        if ($config['width'] === $config['height']) {

            $aspectRatio = '1/1';
        } elseif ($config['width'] >= $config['height']) {

            $aspectRatio = round($config['width'] / $config['height'], 2) . '/1';
        } elseif ($config['width'] <= $config['height']) {

            $aspectRatio = '1/' . round($config['height'] / $config['width'], 2);
        }
        $label = 'Ajuste o posicionamento da imagem';
        $ordemImagem = null;
        return view('panel._layouts.image-crop', compact('image', 'ordemImagem', 'aspectRatio', 'label', 'folder'))
            ->with('cropModule', $this->cropModule)
            ->with('url', $route);
    }
}
