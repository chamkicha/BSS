<div class="row">
            <div class="col-md-4">
                            
                <table>

                    <!--Product No Field -->
                    <tr>
                        <td><strong>{!! Form::label('product_no', 'Product No:') !!}<strong></td>
                        <td>{!! $product->product_no !!}</td>
                    </tr>

                    <!-- Product Name Field -->
                    <tr>
                        <td><strong>{!! Form::label('product_name', 'Product Name:') !!}<strong></td>
                        <td>{!! $product->product_name !!}</td>
                    </tr>

                    <!-- Description Field -->
                    <tr>
                        <td><strong>{!! Form::label('description', 'Description:') !!}<strong></td>
                        <td>{!! $product->description !!}</td>
                    </tr>

                    <!-- Product Unit Field -->
                    <tr>
                        <td><strong>{!! Form::label('product_unit', 'Product Unit:') !!}<strong></td>
                        <td>{!! $product->product_unit !!}</td>
                    </tr>

                    <!-- Product Type Field -->
                    <tr>
                        <td><strong>{!! Form::label('product_type', 'Product Type:') !!}<strong></td>
                        <td>{!! $product->product_type !!}</td>
                    </tr>

                    <!--Created By Field -->
                    <tr>
                        <td><strong>{!! Form::label('created_by', 'Created By:') !!}<strong></td>
                        <td>{!! $product->created_by !!}</td>
                    </tr>

                    <!--Created At Field -->
                    <tr>
                        <td><strong>{!! Form::label('created_at', 'Created At:') !!}<strong></td>
                        <td>{!! \Carbon\Carbon::parse($product->created_at)->format('d-M-y') !!}</td>
                    </tr>


                </table>    

            </div>
            <div class="col-md-4">
                            
                <table>

                    <!-- V A T(%) Field -->
                    <tr>
                        <td><strong>{!! Form::label('v_a_t', 'V A T(%):') !!}<strong></td>
                        <td>{!! $product->v_a_t !!}</td>
                    </tr>

                    <!--E D(%) Field -->
                    <tr>
                        <td><strong>{!! Form::label('e_d', 'E D(%):') !!}<strong></td>
                        <td>{!! $product->e_d !!}</td>
                    </tr>

                    <!--Discount(%) Field -->
                    <tr>
                        <td><strong>{!! Form::label('discount', 'Discount(%):') !!}<strong></td>
                        <td>{!! $product->discount !!}</td>
                    </tr>

                    <!--Price( T Z S) Field -->
                    <tr>
                        <td><strong>{!! Form::label('price', 'Price(TZS):') !!}<strong></td>
                        <td>{!! number_format($product->price,2) !!}</td>
                    </tr>

                    <!--vat amount Field -->
                    <tr>
                        <td><strong>{!! Form::label('vat_amount', 'V A T( TZS):') !!}<strong></td>
                        <td>{{ number_format($product->vat_amount,2) }}</td>
                    </tr>

                    <!--grand total Field -->
                    <tr>
                        <td><strong>{!! Form::label('grand_total', 'Grand Total(TZS):') !!}<strong></td>
                        <td>{!! number_format($product->grand_total,2) !!}</td>
                    </tr>

                </table>
            
            </div>
            <div class="col-md-4">

            </div>
</div>



