<?php

namespace App\Controllers;

use App\Models\Barang;

use App\Models\Perbaikan;

use App\Models\Pesanan;

use App\Models\PesananBarang;

use App\Models\Customer;

use App\Models\KategoriCustomer;

use App\Models\Bagian;

use App\Models\Pegawai;

use App\Models\Divisi;

use App\Models\Suplier;

use App\Models\JenisBarang;

use App\Models\SatuanBarang;

use App\Models\KondisiBarang;

use App\Models\StatusRencana;

use App\Models\KategoriRencana;

use App\Models\FotoKegiatan;

use App\Models\Notif;

use App\Models\User;

// use Matrix\Operators\Division;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Admin extends BaseController
{
    protected $barang;
    protected $perbaikan;
    protected $pesanan;
    protected $pesananBarang;
    protected $xlsx;
    protected $customer;
    protected $pegawai;
    protected $divisi;
    protected $suplier;
    protected $kategoriCustomer;
    protected $bagian;
    protected $jenis_barang;
    protected $satuan_barang;
    protected $kondisi_barang;
    protected $status_rencana;
    protected $kategori_rencana;
    protected $cart;
    protected $foto_kegiatan;
    protected $notif;
    protected $user;

    public function __construct()
    {
        $this->barang = new Barang();
        $this->xlsx = new Xlsx();
        $this->perbaikan = new Perbaikan();
        $this->pesanan = new Pesanan();
        $this->pesananBarang = new PesananBarang();
        $this->customer = new Customer();
        $this->pegawai = new Pegawai();
        $this->divisi = new Divisi();
        $this->suplier = new Suplier();
        $this->kategoriCustomer = new KategoriCustomer();
        $this->bagian = new Bagian();
        $this->jenis_barang = new JenisBarang();
        $this->satuan_barang = new SatuanBarang();
        $this->kondisi_barang = new KondisiBarang();
        $this->status_rencana = new StatusRencana();
        $this->kategori_rencana = new KategoriRencana();
        $this->cart = \Config\Services::cart();
        $this->foto_kegiatan = new FotoKegiatan();
        $this->notif = new Notif();
        $this->user = new User();
    }

    public function index()
    {
        
        // dd($no_trx[0]['id']);
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jumlah_barang' => $this->barang->countAllResults(),
            'jumlah_laptop' => $this->barang->jumlah_barang('LAPTOP'),
            'jumlah_printer' => $this->barang->jumlah_barang('PRINTER'),
            'jumlah_monitor' => $this->barang->jumlah_barang('MONITOR'),
            'jumlah_server' => $this->barang->jumlah_barang('SERVER'),
            'jumlah_fc' => $this->barang->jumlah_barang('MESIN FOTOCOPY'),
            'jumlah_bs' => $this->barang->jumlah_barang('BARCODE SCANER'),
            'jumlah_pc' => $this->barang->jumlah_barang('PC DESKTOP'),
            'jumlah_pc_all' => $this->barang->jumlah_barang('PC ALL IN ONE'),
            'jumlah_projector' => $this->barang->jumlah_barang('PROJECTOR'),
            'jumlah_sw' => $this->barang->jumlah_barang('SWICH HUB 8 PORT') +  $this->barang->jumlah_barang('SWICH HUB 16 PORT') +  $this->barang->jumlah_barang('SWICH HUB 24 PORT') +  $this->barang->jumlah_barang('SWICH HUB 48 PORT'),
            'jumlah_modem' => $this->barang->jumlah_barang('MODEM'),
            'jumlah_speaker' => $this->barang->jumlah_barang('SPEAKER'),
            'jumlah_tv' => $this->barang->jumlah_barang('TV LED'),
            'jumlah_tablet' => $this->barang->jumlah_barang('TABLET'),
            'jumlah_ups' => $this->barang->jumlah_barang('UPS'),
            'perencanaan' => $this->pesanan->where('status_rencana', 'Pesan')->orderBy('mulai_sewa', 'DESC')->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'jumlah_perencanaan' => $this->pesanan->where(['status_rencana' => 'Pesan'])->countAllResults(),
            'jumlah_barang_siap_sewa' => $this->barang->where('status', 'Siap Sewa')->countAllResults(),
            'jumlah_penyewaan' => $this->pesanan->where('status_pesanan', 'Sewa Aktif')->countAllResults()
        ];
        // dd($this->barang->jumlah_barang('PRINTER'));
        return view('pages/admin/index', $data);
    }

    public function customer()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'customer' => $this->customer->findAll(),
            'kategori_customer' => $this->kategoriCustomer->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/customer', $data);
    }

    public function save_customer()
    {
        $this->customer->save([
            'customer' => $this->request->getVar('customer'),
            // 'nama_pic' => $this->request->getVar('nama_pic'),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat'),
            'kategori' => $this->request->getVar('kategori')
        ]);

        session()->setFlashdata('pesan', 'Data Customer Berhasil di Tambahkan');
        return redirect()->to('/admin/customer');
    }

    public function edit_customer()
    {
        $this->customer->save([
            'id' => $this->request->getVar('id'),
            'customer' => $this->request->getVar('customer'),
            // 'nama_pic' => $this->request->getVar('nama_pic'),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat'),
            'kategori' => $this->request->getVar('kategori')
        ]);

        session()->setFlashdata('pesan', 'Data Customer Berhasil di Edit');
        return redirect()->to('/admin/customer');
    }

    public function delete_customer(int $id)
    {
        $this->customer->delete($id);

        session()->setFlashdata('pesan', 'Data Customer Berhasil di Hapus');
        return redirect()->to('/admin/customer');
    }

    public function kategori_customer()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'kategori_customer' => $this->kategoriCustomer->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/kategori_customer', $data);
    }

    public function save_kategori_customer()
    {
        $this->kategoriCustomer->save([
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);

        session()->setFlashdata('pesan', 'Data Kategori Customer Berhasil di Tambahkan');
        return redirect()->to('/admin/kategori_customer');
    }

    public function edit_kategori_customer()
    {
        $this->kategoriCustomer->save([
            'id' => $this->request->getVar('id'),
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);

        session()->setFlashdata('pesan', 'Data Kategori Customer Berhasil di Ubah');
        return redirect()->to('/admin/kategori_customer');
    }

    public function delete_kategori_customer(int $id)
    {
        $this->kategoriCustomer->delete($id);

        session()->setFlashdata('pesan', 'Data Kategori Customer Berhasil di Hapus');
        return redirect()->to('/admin/kategori_customer');
    }

    public function bagian()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'bagian' => $this->bagian->findAll(),
            'customer' => $this->customer->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/bagian', $data);
    }

    public function save_bagian()
    {
        $this->bagian->save([
            'nama_bagian' => $this->request->getVar('nama_bagian'),
            'customer' => $this->request->getVar('customer')
        ]);

        session()->setFlashdata('pesan', 'Data Bagian Berhasil di Tambahkan');
        return redirect()->to('/admin/bagian');
    }

    public function edit_bagian()
    {
        $this->bagian->save([
            'id' => $this->request->getVar('id'),
            'nama_bagian' => $this->request->getVar('nama_bagian'),
            'customer' => $this->request->getVar('customer')
        ]);

        session()->setFlashdata('pesan', 'Data Bagian Berhasil di Edit');
        return redirect()->to('/admin/bagian');
    }

    public function delete_bagian(int $id)
    {
        $this->bagian->delete($id);

        session()->setFlashdata('pesan', 'Data Bagian Berhasil di Hapus');
        return redirect()->to('/admin/bagian');
    }

    public function jenis_barang()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
        ];

        return view('pages/admin/jenis_barang', $data);
    }

    public function save_jenis_barang()
    {
        $this->jenis_barang->save([
            'nama_jenis' => strtoupper($this->request->getVar('nama_jenis'))
        ]);

        session()->setFlashdata('pesan', 'Data Jenis Barang Berhasil di Tambahkan');
        return redirect()->to('/admin/jenis_barang');
    }

    public function edit_jenis_barang()
    {
        $this->jenis_barang->save([
            'id' => $this->request->getVar('id'),
            'nama_jenis' => strtoupper($this->request->getVar('nama_jenis'))
        ]);

        session()->setFlashdata('pesan', 'Data Jenis Barang Berhasil di Edit');
        return redirect()->to('/admin/jenis_barang');
    }

    public function delete_jenis_barang(int $id)
    {
        $this->jenis_barang->delete($id);

        session()->setFlashdata('pesan', 'Data Jenis Barang Berhasil di Hapus');
        return redirect()->to('/admin/jenis_barang');
    }

    public function pegawai()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'pegawai' => $this->pegawai->findAll(),
            'divisi' => $this->divisi->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/pegawai', $data);
    }

    public function save_pegawai()
    {
        $this->pegawai->save([
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'divisi' => $this->request->getVar('divisi'),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat')
        ]);

        session()->setFlashdata('pesan', 'Data Pegawai Berhasil di Tambahkan');
        return redirect()->to('/admin/pegawai');
    }

    public function edit_pegawai()
    {
        $this->pegawai->save([
            'id' => $this->request->getVar('id'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'divisi' => $this->request->getVar('divisi'),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat')
        ]);

        session()->setFlashdata('pesan', 'Data Pegawai Berhasil di Edit');
        return redirect()->to('/admin/pegawai');
    }

    public function delete_pegawai(int $id)
    {
        $this->pegawai->delete($id);

        session()->setFlashdata('pesan', 'Data Pegawai Berhasil di Hapus');
        return redirect()->to('/admin/pegawai');
    }

    public function divisi()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'divisi' => $this->divisi->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/divisi', $data);
    }

    public function save_divisi()
    {
        $this->divisi->save([
            'nama_divisi' => $this->request->getVar('nama_divisi')
        ]);

        session()->setFlashdata('pesan', 'Data Divisi Berhasil di Tambahkan');
        return redirect()->to('/admin/divisi');
    }

    public function edit_divisi()
    {
        $this->divisi->save([
            'id' => $this->request->getVar('id'),
            'nama_divisi' => $this->request->getVar('nama_divisi')
        ]);

        session()->setFlashdata('pesan', 'Data Divisi Berhasil di Ubah');
        return redirect()->to('/admin/divisi');
    }

    public function delete_divisi(int $id)
    {
        $this->divisi->delete($id);

        session()->setFlashdata('pesan', 'Data Divisi Berhasil di Hapus');
        return redirect()->to('/admin/divisi');
    }


    public function satuan_barang()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'satuan_barang' => $this->satuan_barang->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/satuan_barang', $data);
    }

    public function save_satuan_barang()
    {
        $this->satuan_barang->save([
            'nama_satuan' => $this->request->getVar('nama_satuan')
        ]);

        session()->setFlashdata('pesan', 'Data Satuan Berhasil di Tambahkan');
        return redirect()->to('/admin/satuan_barang');
    }

    public function edit_satuan_barang()
    {
        $this->satuan_barang->save([
            'id' => $this->request->getVar('id'),
            'nama_satuan' => $this->request->getVar('nama_satuan')
        ]);

        session()->setFlashdata('pesan', 'Data Satuan Berhasil di Ubah');
        return redirect()->to('/admin/satuan_barang');
    }

    public function delete_satuan_barang(int $id)
    {
        $this->satuan_barang->delete($id);

        session()->setFlashdata('pesan', 'Data Satuan Berhasil di Hapus');
        return redirect()->to('/admin/satuan_barang');
    }

    public function kondisi_barang()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'kondisi_barang' => $this->kondisi_barang->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/kondisi_barang', $data);
    }

    public function save_kondisi_barang()
    {
        $this->kondisi_barang->save([
            'nama_kondisi' => $this->request->getVar('nama_kondisi')
        ]);

        session()->setFlashdata('pesan', 'Data Kondisi Berhasil di Tambahkan');
        return redirect()->to('/admin/kondisi_barang');
    }

    public function edit_kondisi_barang()
    {
        $this->kondisi_barang->save([
            'id' => $this->request->getVar('id'),
            'nama_kondisi' => $this->request->getVar('nama_kondisi')
        ]);

        session()->setFlashdata('pesan', 'Data Kondisi Berhasil di Edit');
        return redirect()->to('/admin/kondisi_barang');
    }

    public function delete_kondisi_barang(int $id)
    {
        $this->kondisi_barang->delete($id);

        session()->setFlashdata('pesan', 'Data Kondisi Berhasil di Hapus');
        return redirect()->to('/admin/kondisi_barang');
    }

    public function suplier()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'suplier' => $this->suplier->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/suplier', $data);
    }

    public function save_suplier()
    {
        $this->suplier->save([
            'nama_suplier' => $this->request->getVar('nama_suplier'),
            'nama_pic' => $this->request->getVar('nama_pic'),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat')
        ]);

        session()->setFlashdata('pesan', 'Data Suplier Berhasil di Tambahkan');
        return redirect()->to('/admin/suplier');
    }

    public function edit_suplier()
    {
        $this->suplier->save([
            'id' => $this->request->getVar('id'),
            'nama_suplier' => $this->request->getVar('nama_suplier'),
            'nama_pic' => $this->request->getVar('nama_pic'),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat')
        ]);

        session()->setFlashdata('pesan', 'Data Suplier Berhasil di Ubah');
        return redirect()->to('/admin/suplier');
    }

    public function delete_suplier(int $id)
    {
        $this->suplier->delete($id);

        session()->setFlashdata('pesan', 'Data Suplier Berhasil di Hapus');
        return redirect()->to('/admin/suplier');
    }

    public function aset(string $kategori = '')
    {
        if ($kategori == '') {
            $aset = $this->barang->findAll();
        } else {
            $aset = $this->barang->where(['kategori_barang' => $kategori])->findAll();
        }

        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'aset' => $aset,
            'kategori' => $kategori,
            'type' => $this->jenis_barang->findAll(),
            'satuan' => $this->satuan_barang->findAll(),
            'suplier' => $this->suplier->findAll(),
            'status' => $this->kondisi_barang->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/aset', $data);
    }

    public function aset_siap(string $kategori = '')
    {
        if ($kategori == '') {
            $aset = $this->barang->where(['status' => 'Siap Sewa'])->findAll();
        } else {
            $aset = $this->barang->where(['kategori_barang' => $kategori, 'status' => 'Siap Sewa'])->findAll();
        }

        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'aset' => $aset,
            'kategori' => $kategori,
            'type' => $this->jenis_barang->findAll(),
            'satuan' => $this->satuan_barang->findAll(),
            'suplier' => $this->suplier->findAll(),
            'status' => $this->kondisi_barang->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/aset_siap', $data);
    }

    public function aset_karantina(string $kategori = '')
    {
        if ($kategori == '') {
            $aset = $this->barang->where(['status' => 'Di Karantina'])->findAll();
        } else {
            $aset = $this->barang->where(['kategori_barang' => $kategori, 'status' => 'Di Karantina'])->findAll();
        }

        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'aset' => $aset,
            'kategori' => $kategori,
            'type' => $this->jenis_barang->findAll(),
            'satuan' => $this->satuan_barang->findAll(),
            'suplier' => $this->suplier->findAll(),
            'status' => $this->kondisi_barang->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/aset_karantina', $data);
    }

    public function aset_tidak_siap(string $kategori = '')
    {
        if ($kategori == '') {
            $aset = $this->barang->where('status !=', 'Siap Sewa')->findAll();
        } else {
            $aset = $this->barang->where(['kategori_barang' => $kategori])->where('status !=', 'Siap Sewa')->findAll();
        }

        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'aset' => $aset,
            'kategori' => $kategori,
            'type' => $this->jenis_barang->findAll(),
            'satuan' => $this->satuan_barang->findAll(),
            'suplier' => $this->suplier->findAll(),
            'status' => $this->kondisi_barang->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/aset_tidak_siap', $data);
    }

    public function aset_pengecekan(string $kategori = '')
    {
        if ($kategori == '') {
            $aset = $this->barang->where('status', 'Rusak')->findAll();
        } else {
            $aset = $this->barang->where(['kategori_barang' => $kategori])->where('status', 'Rusak')->findAll();
        }

        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'aset' => $aset,
            'kategori' => $kategori,
            'type' => $this->jenis_barang->findAll(),
            'satuan' => $this->satuan_barang->findAll(),
            'suplier' => $this->suplier->findAll(),
            'status' => $this->kondisi_barang->findAll(),
            'teknisi' => $this->pegawai->where('divisi', 'TEKNISI')->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/aset_pengecekan', $data);
    }


    public function import_barang_xls()
    {
        if (!$this->validate([
            'files' => 'uploaded[files]|ext_in[files,xlsx]'
        ])) {
            session()->setFlashdata('pesan', 'Anda Harus Memasukan File Berformat xlsx');
            return redirect()->to('/admin/aset');
        }
        $file = $this->request->getFile('files');
        // dd($file);
        $spreadsheet = $this->xlsx->load($file);
        $data = $spreadsheet->getActiveSheet()->toArray();
        // dd($data);
        foreach ($data as $idx => $row) {
            if ($idx == 0) {
                continue;
            }
            // d($row);
            $this->barang->save([
                'nama_barang' => $row[0],
                'barcode' => $row[1],
                'kategori_barang' => $row[2],
                'merek' => $row[3],
                'type' => $row[4],
                'serial_number' => $row[5],
                'procesor' => $row[6],
                'storage' => $row[7],
                'ram' => $row[8],
                'grafis' => $row[9],
                'satuan_barang' => $row[10],
                'tanggal_pembelian' => $row[11],
                'suplier' => $row[12],
                'status' => $row[13]
            ]);
        }

        session()->setFlashdata('pesan', 'Data dari File Excel Berhasil di Masukan');
        return redirect()->to('/admin/aset');
    }

    public function save_aset()
    {
        $this->barang->save([
            'nama_barang' => $this->request->getVar('nama_barang'),
            'barcode' => $this->request->getVar('barcode'),
            'kategori_barang' => $this->request->getVar('kategori_barang'),
            'merek' => $this->request->getVar('merek'),
            'type' => $this->request->getVar('type'),
            'serial_number' => $this->request->getVar('serial_number'),
            'procesor' => $this->request->getVar('procesor'),
            'storage' => $this->request->getVar('storage'),
            'ram' => $this->request->getVar('ram'),
            'grafis' => $this->request->getVar('grafis'),
            'satuan_barang' => $this->request->getVar('satuan_barang'),
            'tanggal_pembelian' => $this->request->getVar('tanggal_pembelian'),
            'suplier' => $this->request->getVar('suplier'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');
        $kategori_barang = $this->request->getVar('kategori_barang');

        return redirect()->to('/admin/aset/' . $kategori_barang);
    }

    public function edit_aset()
    {
        $this->barang->save([
            'id' => $this->request->getVar('id'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'barcode' => $this->request->getVar('barcode'),
            'kategori_barang' => $this->request->getVar('kategori_barang'),
            'merek' => $this->request->getVar('merek'),
            'type' => $this->request->getVar('type'),
            'serial_number' => $this->request->getVar('serial_number'),
            'procesor' => $this->request->getVar('procesor'),
            'storage' => $this->request->getVar('storage'),
            'ram' => $this->request->getVar('ram'),
            'grafis' => $this->request->getVar('grafis'),
            'satuan_barang' => $this->request->getVar('satuan_barang'),
            'tanggal_pembelian' => $this->request->getVar('tanggal_pembelian'),
            'suplier' => $this->request->getVar('suplier'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Ubah');
        $kategori_barang = $this->request->getVar('kategori_barang');

        return redirect()->to('/admin/aset/' . $kategori_barang);
    }

    public function delete_aset(int $id)
    {
        $data = $this->barang->find($id);
        $kategori = $data['kategori_barang'];
        $this->barang->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Hapus');
        return redirect()->to('/admin/aset/' . $kategori);
    }

    public function status_rencana()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'status_rencana' => $this->status_rencana->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/status_rencana', $data);
    }

    public function save_status_rencana()
    {
        $this->status_rencana->save([
            'nama_status' => $this->request->getVar('nama_status')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');
        return redirect()->to('/admin/status_rencana');
    }

    public function edit_status_rencana()
    {
        $this->status_rencana->save([
            'id' => $this->request->getVar('id'),
            'nama_status' => $this->request->getVar('nama_status')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Ubah');
        return redirect()->to('/admin/status_rencana');
    }

    public function delete_status_rencana(int $id)
    {
        $this->status_rencana->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Hapus');
        return redirect()->to('/admin/status_rencana');
    }

    public function kategori_rencana()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'kategori_rencana' => $this->kategori_rencana->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/kategori_rencana', $data);
    }

    public function save_kategori_rencana()
    {
        $this->kategori_rencana->save([
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');
        return redirect()->to('/admin/kategori_rencana');
    }

    public function edit_kategori_rencana()
    {
        $this->kategori_rencana->save([
            'id' => $this->request->getVar('id'),
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Ubah');
        return redirect()->to('/admin/kategori_rencana');
    }

    public function delete_kategori_rencana(int $id)
    {
        $this->kategori_rencana->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di Hapus');
        return redirect()->to('/admin/kategori_rencana');
    }

    public function perencanaan()
    {
        $where = "status_rencana = 'Batal' OR status_rencana='Pesan'";
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'perencanaan' => $this->pesanan->where($where)->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/perencanaan', $data);
    }

    public function tambah_perencanaan()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'customer' => $this->customer->findAll(),
            'bagian' => $this->bagian->join('customer', 'bagian.customer=customer.customer')->findAll(),
            'status' => $this->status_rencana->findAll(),
            'kategori_rencana' => $this->kategori_rencana->findAll()
        ];

        // dd($this->bagian->join('customer', 'bagian.customer=customer.customer')->findAll());

        return view('pages/admin/tambah/perencanaan', $data);
    }

    public function save_tambah_perencanaan()
    {
        $no_trx=$this->pesanan->selectMax('id')->get()->getResultArray();        
        
        if ($this->request->getVar('status_rencana') == 'Confrim') {
            $status_pesanan = 'Confrim';
        } else {
            $status_pesanan = '';
        }

        if ($this->request->getVar('kategori_rencana') == 'Sewa') {
            $no_transaksi = sprintf("%05s", $no_trx[0]['id'] + 1) . '/' . 'SW' . '/' . date('m') . '/' . date('Y');
        } elseif ($this->request->getVar('kategori_rencana') == 'Pinjam') {
            $no_transaksi = sprintf("%05s", $no_trx[0]['id'] + 1) . '/' . 'PJ' . '/' . date('m') . '/' . date('Y');
        } else {
            $no_transaksi = sprintf("%05s", $no_trx[0]['id'] + 1) . '/' . 'HB' . '/' . date('m') . '/' . date('Y');
        }

        $this->pesanan->save([
            'no_transaksi' => $no_transaksi,
            'nama_instansi' => $this->request->getVar('nama_instansi'),
            'sub_instansi' => $this->request->getVar('nama_sub_instansi'),
            'nama_pic' => $this->request->getVar('nama_pic'),
            'mulai_sewa' => $this->request->getVar('mulai_sewa'),
            'selesai_sewa' => $this->request->getVar('selesai_sewa'),
            'lokasi' => $this->request->getVar('lokasi'),
            'catatan' => $this->request->getVar('catatan'),
            'status_rencana' => $this->request->getVar('status_rencana'),
            'status_pesanan' => $status_pesanan,
            'kategori_rencana' => $this->request->getVar('kategori_rencana')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan');
        return redirect()->to('/admin/perencanaan');
    }

    public function edit_perencanaan(int $id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'perencanaan' => $this->pesanan->find($id),
            'customer' => $this->customer->findAll(),
            'bagian' => $this->bagian->join('customer', 'bagian.customer=customer.customer')->findAll(),
            'status' => $this->status_rencana->findAll(),
            'kategori_rencana' => $this->kategori_rencana->findAll()
        ];

        return view('pages/admin/edit/perencanaan', $data);
    }

    public function save_edit_perencanaan(int $id)
    {
        if ($this->request->getVar('status_rencana') == 'Confrim') {
            $status_pesanan = 'Confrim';
        } else {
            $status_pesanan = '';
        }

        if ($this->request->getVar('kategori_rencana') == 'Sewa') {
            $no_transaksi = sprintf("%05s", $id) . '/' . 'SW' . '/' . date('m') . '/' . date('Y');
        } elseif ($this->request->getVar('kategori_rencana') == 'Pinjam') {
            $no_transaksi = sprintf("%05s", $id) . '/' . 'PJ' . '/' . date('m') . '/' . date('Y');
        } else {
            $no_transaksi = sprintf("%05s", $id) . '/' . 'HB' . '/' . date('m') . '/' . date('Y');
        }

        $this->pesanan->save([
            'id' => $id,
            'no_transaksi' => $no_transaksi,
            'nama_instansi' => $this->request->getVar('nama_instansi'),
            'sub_instansi' => $this->request->getVar('nama_sub_instansi'),
            'nama_pic' => $this->request->getVar('nama_pic'),
            'mulai_sewa' => $this->request->getVar('mulai_sewa'),
            'selesai_sewa' => $this->request->getVar('selesai_sewa'),
            'lokasi' => $this->request->getVar('lokasi'),
            'catatan' => $this->request->getVar('catatan'),
            'status_rencana' => $this->request->getVar('status_rencana'),
            'status_pesanan' => $status_pesanan,
            'kategori_rencana' => $this->request->getVar('kategori_rencana')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di Ubah');
        return redirect()->to('/admin/perencanaan');
    }

    public function delete_perencanaan(int $id)
    {
        $this->pesanan->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil di Hapus');
        return redirect()->to('/admin/perencanaan');
    }

    public function confrim_rencana($id)
    {
        $this->pesanan->save([
            'id' => $id,
            'status_rencana' => 'Confrim',
            'status_pesanan' => 'Confrim'
        ]);

        session()->setFlashdata('pesan', 'Perencanaan Berhasil di Konfirmasi');
        return redirect()->to('/admin/barang_keluar');
    }

    public function cancel_rencana($id)
    {
        $this->pesanan->save([
            'id' => $id,
            'status_rencana' => 'Batal'
        ]);

        session()->setFlashdata('pesan', 'Perencanaan Berhasil di Batalkan');
        return redirect()->to('/admin/perencanaan');
    }

    public function barang_keluar()
    {
        $where = "status_rencana='Confrim' AND status_pesanan='Confrim' OR status_pesanan='Sewa Aktif' OR status_pesanan='Hibah Aktif' OR status_pesanan='Pinjam Aktif' OR status_pesanan='Service Aktif'";
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'perencanaan' => $this->pesanan->where($where)->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'cek_proses' => $this->pesananBarang
        ];

        return view('pages/admin/barang_keluar', $data);
    }

    public function proses_barang_keluar($id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'perencanaan' => $this->pesanan->find($id),
            'customer' => $this->customer->findAll(),
            'bagian' => $this->bagian->join('customer', 'bagian.customer=customer.customer')->findAll(),
            'kategori_rencana' => $this->kategori_rencana->findAll(),
            'barang' => $this->barang->where(['status' => 'Siap Sewa'])->findAll(),
            'cart' => $this->cart->contents()
        ];

        // dd($this->bagian->join('customer', 'bagian.customer=customer.customer')->findAll());

        return view('pages/admin/edit/proses_barang_keluar', $data);
    }

    public function edit_barang_keluar($id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'perencanaan' => $this->pesanan->find($id),
            'customer' => $this->customer->findAll(),
            'bagian' => $this->bagian->join('customer', 'bagian.customer=customer.customer')->findAll(),
            'kategori_rencana' => $this->kategori_rencana->findAll(),
            'barang' => $this->barang->where(['status' => 'Siap Sewa'])->findAll(),
            'pesanan_barang' => $this->pesanan->detail_pesanan($id),
            'foto_kegiatan' => $this->foto_kegiatan->where(['id_pesanan' => $id])->findAll()
        ];

        return view('pages/admin/edit/barang_keluar', $data);
    }

    public function save_proses_barang_keluar($id)
    {

        if ($this->request->getVar('kategori_rencana') == 'Sewa') {
            $no_transaksi = sprintf("%05s", $id) . '/' . 'SW' . '/' . date('m') . '/' . date('Y');
            $status = 'Di Sewa';
            $status_pesanan = 'Sewa Aktif';
        } elseif ($this->request->getVar('kategori_rencana') == 'Pinjam') {
            $no_transaksi = sprintf("%05s", $id) . '/' . 'PJ' . '/' . date('m') . '/' . date('Y');
            $status = 'Di Pinjam';
            $status_pesanan = 'Pinjam Aktif';
        } else {
            $no_transaksi = sprintf("%05s", $id) . '/' . 'HB' . '/' . date('m') . '/' . date('Y');
            $status = 'Di Hibahkan';
            $status = 'Hibah Aktif';
        }

        $this->pesanan->save([
            'id' => $id,
            'no_po' => $this->request->getVar('no_po'),
            'no_transaksi' => $no_transaksi,
            'nama_instansi' => $this->request->getVar('nama_instansi'),
            'sub_instansi' => $this->request->getVar('nama_sub_instansi'),
            'nama_pic' => $this->request->getVar('nama_pic'),
            'mulai_sewa' => $this->request->getVar('mulai_sewa'),
            'selesai_sewa' => $this->request->getVar('selesai_sewa'),
            'lokasi' => $this->request->getVar('lokasi'),
            'catatan' => $this->request->getVar('catatan'),
            'status_pesanan' => $status_pesanan,
            'kategori_rencana' => $this->request->getVar('kategori_rencana')
        ]);

        $foto_kegiatan = $this->request->getFileMultiple('foto_kegiatan');
        if ($foto_kegiatan) {
            foreach ($foto_kegiatan as $fg) {
                if ($fg->getError() == 4) {
                    $namaFoto = '';
                } else {
                    $namaFoto = $fg->getName();
                    $this->foto_kegiatan->save([
                        'id_pesanan' => $id,
                        'nama_foto' => $namaFoto
                    ]);
                    $fg->move('foto_kegiatan/');
                }
            }
        }

        $cart = $this->cart->contents();

        foreach ($cart as $key => $c) {
            $this->pesananBarang->save([
                'id_pesanan' => $id,
                'id_barang' => $c['id']
            ]);

            $this->barang->save([
                'id' => $c['id'],
                'status' => $status
            ]);
        }

        $this->cart->destroy();

        session()->setFlashdata('pesan', 'Pesanan Telah di Proses');
        return redirect()->to('/admin/barang_keluar');
    }
    
    public function akhiri_transaksi($id){
        $data_transaksi = $this->pesanan->find($id);
        
        if($data_transaksi['kategori_rencana'] == 'Pinjam'){
            $status_pesanan = 'Pinjam Berakhir';
        }else if($data_transaksi['kategori_rencana'] == 'Sewa'){
            $status_pesanan = 'Sewa Berakhir';
        }
        
        $this->pesanan->save([
            'id' => $id,
            'status_pesanan' => $status_pesanan
        ]);
        
        return redirect()->to('/admin/pengembalian_barang');
    }

    public function delete_barang_keluar($id)
    {
        $data_pesanan = $this->pesananBarang->where(['id_barang' => $id])->first();
        $this->pesananBarang->where(['id_barang' => $id])->delete();
        $this->barang->save([
            'id' => $id,
            'status' => 'Siap Sewa'
        ]);
        return redirect()->to('/admin/edit_barang_keluar/' . $data_pesanan['id_pesanan']);
    }

    public function insert_cart()
    {
        $id = $this->request->getVar('id');
        $data = $this->barang->find($this->request->getVar('id-barang'));
        // dd($data);
        $cart = $this->cart->contents();

        foreach ($cart as $c) {
            if ($data['serial_number'] == $c['option']['serial_number']) {
                session()->setFlashdata('pesan', 'Data Barang Sudah di Masukan');
                return redirect()->to('/admin/proses_barang_keluar/' . $id);
            }
        }

        $this->cart->insert(array(
            'id'      => $data['id'],
            'qty'     => 1,
            'price'   => '0',
            'name'    => $data['nama_barang'],
            'option'  => array(
                'barcode' => $data['barcode'],
                'kategori' => $data['kategori_barang'],
                'merek' => $data['merek'],
                'type' => $data['type'],
                'serial_number' => $data['serial_number'],
                'procesor' => $data['procesor'],
                'ram' => $data['ram'],
                'storage' => $data['storage'],
                'grafis' => $data['grafis']
            )
        ));


        return redirect()->to('/admin/proses_barang_keluar/' . $id);
    }

    public function delete_item_cart($id_cart, $id_pesanan)
    {
        $this->cart->remove($id_cart);

        return redirect()->to('/admin/proses_barang_keluar/' . $id_pesanan);
    }

    public function insert_pesanan_barang()
    {
        $id = $this->request->getVar('id');
        $id_barang = $this->request->getVar('id-barang');

        $data_pesanan = $this->pesanan->find($id);

        if ($data_pesanan['kategori_rencana'] == 'Sewa') {
            $status = 'Di Sewa';
            $status_pesanan = 'Sewa Aktif';
        } elseif ($data_pesanan['kategori_rencana'] == 'Pinjam') {
            $status = 'Di Pinjam';
            $status_pesanan = 'Pinjam Aktif';
        } else {
            $status = 'Di Hibah';
            $status_pesanan = 'Hibah Aktif';
        }

        $this->pesananBarang->save([
            'id_pesanan' => $id,
            'id_barang' => $id_barang
        ]);

        $this->barang->save([
            'id' => $id_barang,
            'status' => $status
        ]);

        $this->pesanan->save([
            'id' => $id,
            'status_pesanan' => $status_pesanan
        ]);



        return redirect()->to('/admin/edit_barang_keluar/' . $id);
    }

    public function data_cart()
    {
        $this->cart->destroy();
        // dd($this->cart->contents());
    }

    public function cart()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'keranjang' => $this->cart->contents()
        ];

        return view('pages/admin/cart', $data);
    }

    public function surat_jalan($id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'pesanan' => $this->pesanan->find($id),
            'pesanan_barang' => $this->pesanan->detail_pesanan($id)
        ];
        return view('pages/admin/surat_jalan', $data);
    }

    public function perbaikan()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'option_perbaikan' => $this->barang->findAll(),
            'barang' => $this->barang->join('perbaikan', 'barang.id=perbaikan.id_barang')->findAll()

        ];
        return view('pages/admin/perbaikan', $data);
    }

    public function tambah_perbaikan()
    {
        $this->perbaikan->save([
            'id_barang' => $this->request->getVar('id_barang'),
            'tanggal' => $this->request->getVar('tanggal'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        // d($this->perbaikan->findAll());
        session()->setFlashdata('pesan', 'Data Perbaikan Berhasil di Tambahkan');
        return redirect()->to('/admin/perbaikan');
    }

    public function edit_perbaikan()
    {
        $this->perbaikan->save([
            'id' => $this->request->getVar('id_perbaikan'),
            'id_barang' => $this->request->getVar('id_barang'),
            'tanggal' => $this->request->getVar('tanggal'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data Perbaikan Berhasil di Edit');
        return redirect()->to('/admin/perbaikan');
    }

    public function hapus_perbaikan(int $id)
    {
        $this->perbaikan->delete($id);

        session()->setFlashdata('pesan', 'Data Perbaikan Berhasil di Hapus');
        return redirect()->to('/admin/perbaikan');
    }

    public function aset_sewa()
    {
        $where = "STATUS='MASUK' OR STATUS='SIAP'";
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'aset' => $this->barang->where($where)->findAll()
        ];
        // dd($this->barang->where($where)->findAll());
        return view('pages/admin/aset_sewa', $data);
    }

    public function tambah_penyewaan()
    {
        $where = "STATUS='MASUK' OR STATUS='SIAP'";
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'barang' => $this->barang->where($where)->findAll()
        ];

        return view('pages/admin/tambah/sewa', $data);
    }

    // public function save_tambah_penyewaan()
    // {
    //     $jumlah_barang = count($this->request->getVar('id-barang'));
    //     $data_barang = $this->request->getVar('id-barang');
    //     // dd($data_barang);
    //     $this->pesanan->save([
    //         'nama_instansi' => $this->request->getVar('nama_instansi'),
    //         'sub_instansi' => $this->request->getVar('nama_sub_instansi'),
    //         'nama_pic' => $this->request->getVar('nama_pic'),
    //         'mulai_sewa' => $this->request->getVar('mulai_sewa'),
    //         'selesai_sewa' => $this->request->getVar('selesai_sewa'),
    //         'jumlah_unit' => $jumlah_barang,
    //         'lokasi' => $this->request->getVar('lokasi')
    //     ]);

    //     foreach ($data_barang as $id_barang) {
    //         $this->pesananBarang->save([
    //             'id_pesanan' => $this->pesanan->getInsertID(),
    //             'id_barang' =>  $id_barang
    //         ]);
    //     }

    //     session()->setFlashdata('pesan', 'Data Penyewaan Berhasil di Tambahkan');
    //     return redirect()->to('/admin/monitoring_sewa');
    // }

    public function monitoring()
    {
        // dd($this->pesanan->join('pesanan_barang', 'pesanan.id=pesanan_barang.id_pesanan')->join('barang', 'pesanan_barang.id_barang=barang.id')->findAll());
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'instansi' => $this->customer->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/monitoring_sewa', $data);
    }

    public function monitor($instansi)
    {
        // dd($this->pesanan->where(['nama_instansi' => $instansi])->findAll());
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'instansi' => $instansi,
            'jenis_barang' => $this->jenis_barang->findAll(),
            'pesanan' => $this->pesanan->where(['nama_instansi' => $instansi])->findAll(),
            'pesanan_sewa_aktif' => $this->pesanan->where(['nama_instansi' => $instansi, 'status_pesanan' => 'Sewa Aktif'])->countAllResults(),
            'pesanan_pinjam_aktif' => $this->pesanan->where(['nama_instansi' => $instansi, 'status_pesanan' => 'Pinjam Aktif'])->countAllResults(),
            'pesanan_sewa_akhir' => $this->pesanan->where(['nama_instansi' => $instansi, 'status_pesanan' => 'Sewa Berakhir'])->countAllResults(),
            'pesanan_pinjam_akhir' => $this->pesanan->where(['nama_instansi' => $instansi, 'status_pesanan' => 'Pinjam Berakhir'])->countAllResults(),
        ];

        return view('pages/admin/monitor_instansi', $data);
    }

    public function detail_monitor($id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'detail' => $this->pesanan->find($id),
            'detail_barang' => $this->pesanan->detail_pesanan($id)
        ];

        return view('pages/admin/detail_monitor', $data);
    }

    public function pengembalian_barang()
    {
        $where = "status_pesanan='Sewa Berakhir' OR status_pesanan='Pinjam Berakhir' OR status_pesanan='Selesai'";
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'pengembalian_barang' => $this->pesanan->where($where)->findAll()
        ];

        return view('pages/admin/pengembalian_barang', $data);
    }

    public function proses_pengembalian_barang($id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'detail' => $this->pesanan->find($id),
            'detail_barang' => $this->pesanan->detail_pesanan($id),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'petugas' => $this->pegawai->findAll()
        ];

        return view('pages/admin/proses_pengembalian_barang', $data);
    }

    public function detail_pengembalian_barang($id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'detail' => $this->pesanan->find($id),
            'detail_barang' => $this->pesanan->detail_pesanan($id),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'petugas' => $this->pegawai->findAll()
        ];

        return view('pages/admin/detail_pengembalian_barang', $data);
    }

    public function save_proses_pengembalian($id)
    {
        $surat_jalan = $this->request->getFile('surat_jalan');
        $namaFile = $surat_jalan->getName();
        $surat_jalan->move('surat_jalan/');
        $this->pesanan->save([
            'id' => $id,
            'tanggal_pengembalian' => $this->request->getVar('tanggal_pengembalian'),
            'petugas' => $this->request->getVar('petugas'),
            'surat_jalan' => $namaFile,
            'catatan_pengembalian' => $this->request->getVar('catatan'),
            'status_pesanan' => 'Selesai'
        ]);

        $detail_barang = $this->pesanan->detail_pesanan($id);

        foreach ($detail_barang as $db) {
            $this->barang->save([
                'id' => $db['id_barang'],
                'status' => 'Di Karantina'
            ]);
        }

        session()->setFlashdata('pesan', 'Pengembalian Barang Berhasil di Proses');
        return redirect()->to('/admin/pengembalian_barang');
    }

    public function hapus_barang_pengembalian($id_barang, $id_pesanan)
    {
        $this->pesananBarang->where(['id_barang' => $id_barang])->delete();
        $this->barang->save([
            'id' => $id_barang,
            'status' => 'Siap Sewa'
        ]);

        return redirect()->to('/admin/proses_pengembalian_barang/' . $id_pesanan);
    }

    public function delete_foto_kegiatan($id_foto, $id_pesanan)
    {
        $data_foto = $this->foto_kegiatan->find($id_foto);
        unlink('foto_kegiatan/' . $data_foto['nama_foto']);
        $this->foto_kegiatan->delete($id_foto);

        return redirect()->to('/admin/edit_barang_keluar/' . $id_pesanan);
    }

    public function status_karantina()
    {
        $id_barang = $this->request->getVar('id-barang');
        $status = $this->request->getVar('status');
        $this->barang->save([
            'id' => $id_barang,
            'status' => $status
        ]);

        if ($status == 'Siap Sewa') {
            session()->setFlashdata('pesan', 'Data Berhasil di Ubah');
            return redirect()->to('/admin/aset');
        } else {
            session()->setFlashdata('pesan', 'Data Berhasil di Ubah');
            return redirect()->to('/admin/aset_pengecekan');
        }
    }

    public function status_pengecekan()
    {
        $id_barang = $this->request->getVar('id-barang');
        $status_barang = $this->request->getVar('status');
        $this->barang->save([
            'id' => $id_barang,
            'status' => $status_barang
        ]);

        if ($status_barang == 'Siap Sewa') {
            session()->setFlashdata('pesan', 'Data Berhasil di Ubah');
            return redirect()->to('/admin/aset');
        } else {
            session()->setFlashdata('pesan', 'Data Berhasil di Ubah');
            return redirect()->to('/admin/service');
        }
    }

    public function proses_pengecekan()
    {
        $this->barang->save([
            'id' => $this->request->getVar('id-barang-cek'),
            'nama_teknisi' => $this->request->getVar('teknisi'),
            'tanggal_pengecekan' => $this->request->getVar('tanggal_pengecekan'),
            'jenis_kerusakan' => $this->request->getVar('jenis_kerusakan'),
        ]);

        $data_barang = $this->barang->find($this->request->getVar('id-barang-cek'));
        // dd($data_barang);
        return redirect()->to('/admin/aset_pengecekan/' . $data_barang['kategori_barang']);
    }

    public function service()
    {
        // dd($this->barang->where('status', 'Di Service')->findAll());
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'aset' => $this->barang->where('status', 'Di Service')->findAll()
        ];

        return view('pages/admin/service', $data);
    }

    public function proses_service()
    {
        $no_transaksi = rand(11111, 99999) . '/' . 'SV' . '/' . date('m') . '/' . date('Y');
        $this->pesanan->save([
            'no_transaksi' => $no_transaksi,
            'nama_pic' => $this->request->getVar('teknisi'),
            'mulai_sewa' => $this->request->getVar('tanggal_pengiriman'),
            'lokasi' => $this->request->getVar('alamat'),
            'status_pesanan' => 'Service Berjalan'
        ]);
        $nama_barang = $this->request->getVar('barang');
        foreach ($nama_barang as $nb) {
            $this->pesananBarang->save([
                'id_barang' => $nb,
                'id_pesanan' => $this->pesanan->getInsertID()
            ]);

            $this->barang->save([
                'id' => $nb,
                'status' => 'Service Berjalan'
            ]);
        }

        return redirect()->to('/admin/service_keluar');
    }

    public function service_keluar()
    {
        $where = "status_pesanan='Service Berjalan' OR status_pesanan='Service Selesai'";
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'perencanaan' => $this->pesanan->where($where)->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'cek_proses' => $this->pesanan
        ];

        return view('pages/admin/service_keluar', $data);
    }

    public function detail_service_keluar($id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'detail' => $this->pesanan->find($id),
            'detail_barang' => $this->pesanan->detail_pesanan($id),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/detail_service_keluar', $data);
    }

    public function pengembalian_service_keluar()
    {
        $id_pesanan = $this->request->getVar('id-pesanan');
        $tanggal_pengembalian = $this->request->getVar('tanggal_pengembalian');
        $surat_jalan = $this->request->getFile('surat_jalan');
        $namaFile = $surat_jalan->getName();
        // dd($namaFile);
        $surat_jalan->move('surat_jalan/');
        $this->pesanan->save([
            'id' => $id_pesanan,
            'status_pesanan' => 'Service Selesai',
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'surat_jalan' => $namaFile
        ]);

        $data_barang = $this->pesanan->detail_pesanan($id_pesanan);
        foreach ($data_barang as $db) {
            $this->barang->save([
                'id' => $db['id_barang'],
                'status' => 'Di Karantina'
            ]);
        }

        session()->setFlashdata('pesan', 'Pengembalian Service Berhasil & Barang Akan di Karantina');
        return redirect()->to('/admin/pengembalian_service');
    }

    public function pengembalian_service()
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'perencanaan' => $this->pesanan->where(['status_pesanan' => 'Service Selesai'])->findAll(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'cek_proses' => $this->pesanan
        ];

        return view('pages/admin/pengembalian_service', $data);
    }

    public function detail_pengembalian_service_keluar($id)
    {
        $data = [
            'notif' => $this->notif->where('terlihat', 0)->findAll(),
            'jumlah_notif' => $this->notif->where('terlihat', 0)->countAllResults(),
            'detail' => $this->pesanan->find($id),
            'detail_barang' => $this->pesanan->detail_pesanan($id),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/detail_pengembalian_service_keluar', $data);
    }

    public function notif()
    {
        $data = [
            'notif' => $this->notif->where(['terlihat' => 0])->findAll(),
            'data_notif' => $this->notif->findAll(),
            'jumlah_notif' => $this->notif->where(['terlihat' => 0])->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll()
        ];

        return view('pages/admin/notif', $data);
    }

    public function detail_notif($id_notif, $id_pesanan)
    {
        $this->notif->save([
            'id' => $id_notif,
            'terlihat' => 1
        ]);

        return redirect()->to('/admin/detail_monitor/' . $id_pesanan);
    }

    public function pengguna()
    {
        $data = [
            'notif' => $this->notif->where(['terlihat' => 0])->findAll(),
            'jumlah_notif' => $this->notif->where(['terlihat' => 0])->countAllResults(),
            'jenis_barang' => $this->jenis_barang->findAll(),
            'user' => $this->user->findAll()
        ];

        return view('pages/admin/pengguna', $data);
    }

    public function save_pengguna()
    {
        if (!$this->validate([
            'username' => 'required|is_unique[users.username]',
            'email' => 'required|is_unique[users.email]'
        ])) {
            session()->setFlashdata('pesan', 'Username Atau Email Pengguna Sudah Ada');
            return redirect()->to('/admin/pengguna');
        }

        $password = base64_encode(hash('sha384', $this->request->getVar('password'), true));

        $option = [
            'cost' => 10,
        ];

        $this->user->save([
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'active' => $this->request->getVar('active'),
            'password_hash' => password_hash($password, PASSWORD_DEFAULT, $option),
        ]);

        session()->setFlashdata('pesan', 'Pengguna Baru Berhasil diTambahkan');
        return redirect()->to('/admin/pengguna');
    }

    public function edit_pengguna()
    {
        $id_user = $this->request->getVar('id_user');
        $data_pengguna = $this->user->find($id_user);

        if ($data_pengguna['username'] == $this->request->getVar('username')) {
            $rules_username = 'required';
        } else {
            $rules_username = 'required|is_unique[users.username]';
        }

        if ($data_pengguna['email'] == $this->request->getVar('email')) {
            $rules_email = 'required';
        } else {
            $rules_email = 'required|is_unique[users.email]';
        }

        if (!$this->validate([
            'username' => $rules_username,
            'email' => $rules_email
        ])) {
            session()->setFlashdata('pesan', 'Username Atau Email Pengguna Sudah Ada');
            return redirect()->to('/admin/pengguna');
        }

        if ($this->request->getVar('password') == '') {
            $this->user->save([
                'id' => $id_user,
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'active' => $this->request->getVar('active')
            ]);
            session()->setFlashdata('pesan', 'Pengguna Baru Berhasil diUbah');
            return redirect()->to('/admin/pengguna');
        } else {

            $password = base64_encode(hash('sha384', $this->request->getVar('password'), true));

            $option = [
                'cost' => 10,
            ];

            $this->user->save([
                'id' => $id_user,
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'active' => $this->request->getVar('active'),
                'password_hash' => password_hash($password, PASSWORD_DEFAULT, $option),
            ]);

            session()->setFlashdata('pesan', 'Pengguna Baru Berhasil diUbah');
            return redirect()->to('/admin/pengguna');
        }
    }

    public function delete_pengguna($id)
    {
        $this->user->delete($id);

        session()->setFlashdata('pesan', 'Pengguna Baru Berhasil diHapus');
        return redirect()->to('/admin/pengguna');
    }
    //--------------------------------------------------------------------

}
