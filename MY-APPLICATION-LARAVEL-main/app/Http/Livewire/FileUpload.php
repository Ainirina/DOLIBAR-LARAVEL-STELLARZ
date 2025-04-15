<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $name;
    public $file;
    public $preview;
    public $fileType = 'image';
    public $accept = 'image/*';
    public $uploadStatus = 'idle';
    public $uploadMessage = '';

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|file|max:1024',
        ]);

        $this->uploadStatus = 'uploading';
        $this->uploadMessage = 'Uploading... tap to cancel';

        sleep(3);

        if ($this->fileType === 'image') {
            $this->preview = $this->file->temporaryUrl();
        }

        $this->uploadStatus = 'complete';
        $this->uploadMessage = 'Upload complete. Tap to undo.';
    }

    public function resetFile()
    {
        $this->reset('file', 'preview', 'uploadStatus', 'uploadMessage');
    }

    public function cancelUpload()
    {
        $this->resetFile();
    }

    public function render()
    {
        return view('livewire.file-upload');
    }
}