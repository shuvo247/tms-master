<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class=" mdi mdi-home-outline"></i>
                                <span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                           class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Purchase </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="ticket-list.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket List </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Product </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                 <li class="sidebar-item">
                                    <a href="{{route('product.category.list')}}" class="sidebar-link">
                                    <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Add Categories </span>
                                    </a>
                                 </li>
                                 <li class="sidebar-item">
                                    <a href="{{route('product.brand.list')}}" class="sidebar-link">
                                       <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Add Brand </span>
                                    </a>
                                 </li>
                                 <li class="sidebar-item">
                                    <a href="{{route('product.payment-method.list')}}" class="sidebar-link">
                                       <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Payment Method </span>
                                    </a>
                                 </li>
                                 <li class="sidebar-item">
                                    <a href="{{route('product.attribute.list')}}" class="sidebar-link">
                                    <i class="mdi mdi-minus"></i><span class="hide-menu"> Attribute / Variation </span>
                                 </a>
                                 </li>
                                <li class="sidebar-item">
                                    <a href="{{route('product.product.add')}}" class="sidebar-link">
                                       <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Add Product </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{route('product.product.list')}}" class="sidebar-link">
                                       <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Product List </span>
                                    </a>
                                </li>
                                 <li class="sidebar-item">
                                    <a href="" class="sidebar-link">
                                       <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Bulk Opening Stock </span>
                                    </a>
                                 </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-email-outline"></i><span
                              class="hide-menu">Register </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                 <li class="sidebar-item"><a href="{{route('register.supplier.supplier-type.list')}}" class="sidebar-link"><i
                                    class="mdi mdi-minus"></i><span class="hide-menu"> Supplier Type </span></a>
                                 </li>
                                 <li class="sidebar-item">
                                    <a href="{{route('register.organization.list')}}" class="sidebar-link">
                                       <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Add Organization </span>
                                    </a>
                                 </li>
                                 <li class="sidebar-item">
                                    <a href="{{route('register.supplier.list')}}" class="sidebar-link">
                                       <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Add Supplier </span>
                                    </a>
                                 </li>
                                 <li class="sidebar-item">
                                    <a href="{{route('register.reference.list')}}" class="sidebar-link">
                                       <i class="mdi mdi-minus"></i>
                                       <span class="hide-menu"> Add Reference </span>
                                    </a>
                                 </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                           class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Damage </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="ticket-list.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket List </span></a>
                                </li>
                                <li class="sidebar-item"><a href="ticket-detail.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket Detail </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                           class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Account </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="ticket-list.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket List </span></a>
                                </li>
                                <li class="sidebar-item"><a href="ticket-detail.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket Detail </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                           class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Messaging </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="ticket-list.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket List </span></a>
                                </li>
                                <li class="sidebar-item"><a href="ticket-detail.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket Detail </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                           class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Report </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="ticket-list.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket List </span></a>
                                </li>
                                <li class="sidebar-item"><a href="ticket-detail.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket Detail </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                           class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Basic Setting </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="ticket-list.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket List </span></a>
                                </li>
                                <li class="sidebar-item"><a href="ticket-detail.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket Detail </span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>