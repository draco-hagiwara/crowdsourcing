<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

# include TCPDF
#require_once(APPPATH.'third_party/tcpdf/config/lang/jpn.php');
require_once(APPPATH . '/third_party/tcpdf/tcpdf.php');
require_once(APPPATH . '/third_party/tcpdf/fpdi.php');


/**
 * TCPDF - CodeIgniter Integration
 */
class Pdf extends TCPDF {

    /**
     * Initialize
     *
     */
    function __construct($params = array())
    {
        $orientation = 'P';
        $unit = 'mm';
        $format = 'A4';
        $unicode = true;
        $encoding = 'UTF-8';
        $diskcache = false;

        if (isset($params['orientation'])) {
            $orientation = $params['orientation'];
        }
        if (isset($params['unit'])) {
            $unit = $params['unit'];
        }
        if (isset($params['format'])) {
            $format = $params['format'];
        }
        if (isset($params['encoding'])) {
            $encoding = $params['encoding'];
        }
        if (isset($params['diskcache'])) {
            $diskcache = $params['diskcache'];
        }

        # initialize TCPDF
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
    }

    /**
     * アドミン：クライアント請求＆ポイント明細
     *
     */
    public function pdf_paycldetail()
    {


    	$pdf = new FPDI();							// 組み込んだらFPDIを呼び出す
    	$pdf->SetMargins(0, 0, 0);					// PDFの余白(上左右)を設定
    	$pdf->SetCellPadding(0);					// セルパディングの設定
    	$pdf->SetAutoPageBreak(false);				// 自動改ページを無効(writeHTMLcellはこれを無効にしても自動改行される)
    	$pdf->setPrintHeader(false);				// ページヘッダを無効
    	$pdf->setPrintFooter(false);				// ページフッタを無効
    	$pdf->AddPage();							// 空のページを追加

    	// ノーマルフォントとボールドフォントを追加
    	$font_path1 = APPPATH . '/third_party/tcpdf/fonts/migmix-2p-regular.ttf';
    	$font_path2 = APPPATH . '/third_party/tcpdf/fonts/migmix-2p-bold.ttf';

    	$font = new TCPDF_FONTS();
    	$font1 = $font->addTTFfont($font_path1, '', '', 32);
    	$font2 = $font->addTTFfont($font_path2, '', '', 32);
    	$pdf->SetFont($font1, '', 11);				// フォントをセット
    	$pdf->SetFont($font2, '', 11);				// フォントをセット
    	$pdf->SetTextColor(82, 82, 84);				// フォントの色を設定(RGB)
    	$pdf->SetFontSize(12);						// フォントサイズの設定

    	$pdf->setSourceFile('/home/cs/www/cs.com.dev/htdocs/img/pdf/receipt.pdf');	// PDFテンプレートの読み込み
    	$page = $pdf->importPage(1);				// PDFテンプレートの指定ページを使用する
    	$pdf->useTemplate($page);

    	$pdf->setCellHeightRatio(1.2);				// セルの行間を設定

    	//$pdf->GetY();								// カーソルの現在の位置(Y座標)を取得

    	//$pdf->writeHTMLcell(セル幅, セル高さ, X座標, Y座標, 文字列, 0, 0, false, true, 文字列の位置(右左中央), false);	// PDFにセルを使って文字列(htmlタグを使用)を追加
    	$pdf->writeHTMLcell(50, 1, 30, 80, "AbCdEfG 美しい", 0, 0, false, true, 0, false);	// PDFにセルを使って文字列(htmlタグを使用)を追加

    	//$pdf->Image(画像のパス, X座標, Y座標, 画像のサイズ, '', 'PNG');	// PDFに画像を追加

    	$pdf->Ln();									// 改行の追加

    	$pdf->PageNo();								// $pdf->PageNo();



    	//$pdf->Text(30, 30, "alphabetica ABCDEFG" );
    	//$pdf->Text(30, 80, "美しい日本語のフォントを表示" );


















    	// 表のサイズ ここで設定した値と、DrawBoxの戻り値の描画後表サイズと比較し、まったく同じである場合は、与えた時と現在XY位置が変化ないので描画失敗と見なす
    	$avarRectWorld[ "TOP"    ] = $pdf->GetX();
    	$avarRectWorld[ "LEFT"   ] = $pdf->GetY();
    	$avarRectWorld[ "BOTTOM" ] = $avarRectWorld[ "TOP"  ];
    	$avarRectWorld[ "RIGHT"  ] = $avarRectWorld[ "LEFT" ];

    	// 全角１文字あたりの縦横サイズを設定
    	$avarSizeFont[ "Width"  ] = $pdf->GetStringWidth( "あ" );

    	// Position Y は内部調整するため投入しない 内部で処理しない		Widthには、全角１文字サイズを軸に、何文字記入できるかを設定している
    	// Width値にFontのWidthを足しているのは、マージン分である
    	$avarTitle[ 0 ][ "Title" ] = "商 品 番 号";
    	$avarTitle[ 0 ][ "TextPosition" ] = "L"; //"LEFT";
    	$avarTitle[ 0 ][ "CharByte" ] = $avarSizeFont[ "Width" ] / 2;// 半角文字で統一
    	$avarTitle[ 0 ][ "Rect" ][ "Width" ] = $avarSizeFont[ "Width" ] * 5 + $avarSizeFont[ "Width" ];

    	$avarTitle[ 1 ][ "Title" ] = "商　品　名　　< 入数 >";
    	$avarTitle[ 1 ][ "TextPosition" ] = "L";	//"LEFT";
    	$avarTitle[ 1 ][ "CharByte" ] = $avarSizeFont[ "Width" ];// 全角文字で統一
    	$avarTitle[ 1 ][ "Rect" ][ "Width" ] = $avarSizeFont[ "Width" ] * 14 + $avarSizeFont[ "Width" ];

    	$avarTitle[ 2 ][ "Title" ] = "単　価";
    	$avarTitle[ 2 ][ "TextPosition" ] = "R"; 	//"RIGHT";
    	$avarTitle[ 2 ][ "CharByte" ] = $avarSizeFont[ "Width" ] / 2;// 半角文字で統一
    	$avarTitle[ 2 ][ "Rect" ][ "Width" ] = $avarSizeFont[ "Width" ] * 2 + $avarSizeFont[ "Width" ];

    	$avarTitle[ 3 ][ "Title" ] = "数　量";
    	$avarTitle[ 3 ][ "TextPosition" ] = "R"; 	//"RIGHT";
    	$avarTitle[ 3 ][ "CharByte" ] = $avarSizeFont[ "Width"  ] / 2;// 半角文字で統一
    	$avarTitle[ 3 ][ "Rect" ][ "Width" ] = $avarSizeFont[ "Width" ] * 1 + $avarSizeFont[ "Width" ];

    	$avarTitle[ 4 ][ "Title" ] = "金　　額";
    	$avarTitle[ 4 ][ "TextPosition" ] = "R"; 	//"RIGHT";
    	$avarTitle[ 4 ][ "CharByte" ] = $avarSizeFont[ "Width" ] / 2;// 半角文字で統一
    	$avarTitle[ 4 ][ "Rect" ][ "Width" ] = $avarSizeFont[ "Width" ] * 3 + $avarSizeFont[ "Width" ];

    	// 表項目を作成
    	$pdf->SetFillColor(0xc0, 0xc0, 0xff); 					// タイトル行に背景色
    	setlocale(LC_MONETARY, 'ja_JP');							// 金額フォーマット設定
    	//$index = 0;
    	//foreach( $aobjOrderDetail as $iDetailIndex => $varDetail )
    	//{
    	//	if ( ($varDetail[ "dd_qty" ] != 0) ) {		// 2013.02.01 Chg
    		//		$avarData[ $index ][ "dd_pm_id_1" ] = $varDetail[ "dd_pm_id_1" ];
    		//		$avarData[ $index ][ "dd_name"    ] = mb_convert_kana( $varDetail[ "dd_name" ] . " <" . number_format( $varDetail[ "dd_qty" ] ) . ">" , "ASK", DF_CHARSET );
    		//		$avarData[ $index ][ "dd_price"   ] = number_format( $varDetail[ "dd_price" ] );
    		//		$avarData[ $index ][ "dd_num"     ] = number_format( $varDetail[ "dd_num" ] );
    		//		$avarData[ $index ][ "dd_total"   ] = number_format( $varDetail[ "dd_total" ] );
    		//		$index ++;
    		//	}
    		//}
    		//$avarRectWorldNew = self::DrawBox( $pdf, $avarSizeFont, $avarRectWorld, $avarTitle, $avarData );
    		$avarRectWorldNew = self::DrawBox( $pdf, $avarSizeFont, $avarRectWorld, $avarTitle, 0 );

    		$money_unit = " 円";
    		//$pdf->SetFont( PMINCHO, '', 9 );

    		$pdf->Cell( 100 , 2 , '',  0  );
    		$pdf->Ln();
    		$pdf->Cell( 120 , 2 , '',  0  );
    		$pdf->Cell( 23 , 6 , '小　　　計', 1 , 0 , "L" );
    		//$pdf->Cell( 26 , 6  , $varOrderMaster[ "dm_subtotal" ] . $money_unit , 1 , 0 , "R" );
    		$pdf->Cell( 26 , 6  , "99,999円" , 1 , 0 , "R" );
    		$pdf->Ln();

    		$pdf->Cell( 120 , 2 , '' ,  0 );
    		$pdf->Cell( 23 , 6 , '消　費　税' , 1 , 0 , "L");
    		$pdf->Cell( 26 , 6 , "999円" , 1 , 0 , "R");
    		$pdf->Ln();

    		$pdf->Cell( 120 , 2 , '' ,  0 );
    		$pdf->Cell( 23 , 6 , '送　　　料' , 1 , 0 , "L");
    		$pdf->Cell( 26  , 6 , "555円" , 1 , 0 , "R");
    		$pdf->Ln();




















    		$pdf->Close();
    		$pdf->Output('pdf_cl_paydetail_' . date('YmdHis') . '.pdf' , 'I');







    }




























    // それぞれの項目において、半角もしくは全角に揃えられているものとする
    // 引数
    // 	$objFPDF		mbfpdf オブジェクト
    // 	$avarRectWorld
    // 					$avarRectWorld[ Index ][ "Rect" ][ "Width"  ]	// 表のサイズ 本項は必須であり、列名を表記しない場合でも、列の長さを知る為に必要である
    // 					$avarRectWorld[ Index ][ "Rect" ][ "Height" ]	// 表のサイズ 本項は必須であり、列名を表記しない場合でも、列の高さを知る為に必要である
    // 					$avarRectWorld[ Index ][ "Title" ]				// この項目が空文字の場合は、描画しない	一部の項目のみ、代入されている場合、表の崩れは保証しない
    static function DrawBox( $objFPDF, $avarSizeFont, $avarRectWorld, $avarTitle, $avarData )
    {
    	$avarReturnRect = array();


    	if( NULL != $avarTitle )
    	{
    		foreach( $avarTitle as $iIndex => $varData )
    		{
    			if( "" != $varData[ "Title" ] )
    			{
    				$objFPDF->Cell( $varData[ "Rect" ][ "Width" ], $avarSizeFont[ "Width" ], $varData[ "Title" ] , 1 , 0 , "C" , 1 );
    				//$objFPDF->Cell( $varData[ "Rect" ][ "Width" ], $avarSizeFont[ "Width" ], $varData[ "Title" ] , 1 , 0 , "C" );
    			}
    		}
    		$objFPDF->Ln();
    	}



    	if( $avarData )
    	{
    		foreach( $avarData[ 0 ] as $strKey => $varValue )
    		{
    			$astrIndex[] = $strKey;
    		}

    		// デバッグが面倒なので、２度行をループします　１度目は文字のWardWrap処理　２度目は表示処理です。
    		foreach( $avarData as $iIndex => $varData )
    		{
    			// 行の作成
    			for( $iFieldLoop = 0; $iFieldLoop < count( $astrIndex ); $iFieldLoop ++ )
    			{
    				$strFieldName = $astrIndex[ $iFieldLoop ];
    				$strWork = "";

    				// 列幅に合うように改行を設定
    				$iWritableWidth = $avarTitle[ $iFieldLoop ][ "Rect" ][ "Width" ] - $avarSizeFont[ "Width" ];	// 枠サイズから余白分１文字を消して
    				$iWritableCount = $iWritableWidth / $avarTitle[ $iFieldLoop ][ "CharByte" ] * 2;				// 文字サイズで枠数を割り、表示可能文字数を算出

    				for( $iLoop = 0; $iLoop < mb_strlen( $avarData[ $iIndex ][ $strFieldName ], DF_CHARSET ); $iLoop ++ )
    				{
    					$strWork .= mb_substr( $avarData[ $iIndex ][ $strFieldName ], $iLoop, 1, DF_CHARSET );

    					if( 0 == ( $iLoop % $iWritableCount ) )
    					{
    						if( 0 != $iLoop )
    						{
    							$strWork .= "\n";
    						}
    					}
    				}
    				$avarData[ $iIndex ][ $strFieldName ] = $strWork . "\n";

    				$astrWork = explode( "\n", $avarData[ $iIndex ][ $strFieldName ] );
    				$avarData[ $iIndex ][ "RowCount" ] = count( $astrWork );
    			}
    		}


    		$iX = $objFPDF->GetX();
    		$iY = $objFPDF->GetY();

    		foreach( $avarData as $iIndex => $varData )
    		{
    			$iWorkY = $iY + $avarData[ $iIndex ][ "RowCount" ] * $avarSizeFont[ "Height" ];
    			if( 270 < $iWorkY )
    			{
    				$iY = 10;
    				$objFPDF->addPage();
    			}

    			$iMaxBottom = $iY;	// その行の最大BOTTOM ＝ 次の行のTOP値
    			$aiRectSize[ "LEFT"   ] = $iX;
    			$aiRectSize[ "TOP"    ] = $iY;
    			$aiRectSize[ "RIGHT"  ] = $aiRectSize[ "LEFT" ];
    			$aiRectSize[ "BOTTOM" ] = $aiRectSize[ "TOP"  ];

    			// 描画
    			for( $iFieldLoop = 0; $iFieldLoop < count( $astrIndex ); $iFieldLoop ++ )
    			{
    				$aiRectSize[ "LEFT"   ] = $aiRectSize[ "RIGHT"  ];
    				$aiRectSize[ "TOP"    ] = $iY;
    				$aiRectSize[ "RIGHT"  ] = $aiRectSize[ "LEFT" ];
    				$aiRectSize[ "BOTTOM" ] = $aiRectSize[ "TOP"  ];

    				$strFieldName = $astrIndex[ $iFieldLoop ];

    				$astrWork = explode( "\n", $avarData[ $iIndex ][ $strFieldName ] );


    				for( $iLine = 0; $iLine < $avarData[ $iIndex ][ "RowCount" ]; $iLine ++ )
    				{
    					if( isset( $astrWork[ $iLine ] ) )
    					{
    						$strString = $astrWork[ $iLine ];
    					}
    					else
    					{
    						$strString = "";
    					}

    					$strBorder = "RL";

    					if( 0 == $iLine )
    						$strBorder .= "T";
    					if( ( $avarData[ $iIndex ][ "RowCount" ] -1 ) == $iLine )
    						$strBorder .= "B";

    					$objFPDF->Cell( $avarTitle[ $iFieldLoop ][ "Rect" ][ "Width" ], $avarSizeFont[ "Width" ], $strString, $strBorder, 0, $avarTitle[ $iFieldLoop ][ "TextPosition" ] );
    					$aiRectSize[ "RIGHT" ] = $objFPDF->GetX();

    					if( $iLine < ( count( $astrWork ) -1 ) )
    					{
    						// 最後の行ではないので、セル内改行である
    						$objFPDF->Ln();
    						$objFPDF->SetX( $aiRectSize[ "LEFT" ] );
    					}
    					else
    					{
    						$avarReturnRect[ $iIndex ][ $iFieldLoop ] = $aiRectSize;
    						$aiRectSize[ "BOTTOM" ] = $objFPDF->GetY();
    						$aiRectSize[ "RIGHT"  ] = $objFPDF->GetX();
    					}
    				}
    				if( $iMaxBottom <= $aiRectSize[ "BOTTOM" ] )
    					$iMaxBottom = $aiRectSize[ "BOTTOM" ];

    				$objFPDF->SetY( $aiRectSize[ "TOP"   ] );
    				$objFPDF->SetX( $aiRectSize[ "RIGHT" ] );
    			}
    			$objFPDF->SetY( $iMaxBottom );
    			$objFPDF->Ln();
    			$iY = $objFPDF->GetY();
    		}
    	}
    	$objFPDF->Ln();

    	return $avarReturnRect;
    }


}

// END pdf Class

/* End of file pdf.php */
/* Location: ./application/libraries/pdf.php */
