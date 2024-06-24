<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="class-title">Devices</h3>
              </div>
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-lg-6">
                    <select class="form-control" id="device_group" aria-describedby="groupHelp" required>
                      <option value="">Choose Group</option>
  
                      <?php foreach ($groups as $value) : ?>
                          <option value="<?= $value['groupId'] ?>" <?= ($value['groupId'] == $this->uri->segment(2) ? 'selected' : '') ?>><?= $value['groupName'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-6">

                    <button class='btn btn-primary add-device mt-lg-0 mt-md-3' data-toggle='modal' data-target='#deviceModal'><i class='fas fa-plus-square'></i> Add Device</button>

                    <a class="btn btn-danger mt-lg-0 mt-md-3" href="<?= base_url('export/'.$this->uri->segment(2)) ?>" target="_blank" rel="noopener"><i class='fas fa-file-pdf'></i> Export Device</a>
                  </div>
                </div>
                <div class="table-responsive">

                  <table id="deviceTable" class="table table-stripped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">Hostname</th>
                        <th class="text-center">Serial Number</th>
                        <th class="no-sort text-center">Manufacture & Model</th>
                        <th class="no-sort text-center">Processor</th>
                        <th class="no-sort text-center">Specification</th>
                        <th class="no-sort text-center">Location</th>
                        <th class="no-sort text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($devices as $dev): ?>
                          <tr>
                              <td><?= $dev['hostname'] ?></td>
                              <td><?= $dev['serialNumber'] ?></td>
                              <td>
                                  Manufacture: <?= $dev['model']['manufacture']['manuName'] ?>
                                  <br>
                                  Model: <?= $dev['model']['modelName'] ?>
                              </td>
                              <td><?= $dev['processor'] ?></td>
                              <td>
                                  Cores: <?= $dev['cores'] ?>
                                  <br>
                                  RAM: <?= $dev['memoryCap'] ?>
                                  <br>
                                  Storage (GB): <?= $dev['storageCap'] ?>
                              </td>
                              <td>
                                  Location: <?= $dev['location'] ?>
                                  <br>
                                  Rack Number: <?= $dev['rackNumber'] ?>
                              </td>
                              <td class="d-flex justify-content-center">
                                  <button class='btn btn-warning edit-device mr-1' data-toggle='modal' data-target='#deviceModal' data-id='<?= $dev['deviceId'] ?>'><i class='fas fa-edit'></i> Edit</button>
                                  <button href='#' data-id='<?= $dev['deviceId'] ?>' class='btn btn-danger delete-device'><i class='fas fa-trash-alt'></i> Delete</button>
                              </td>
                          </tr>
  
                          <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deviceModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deviceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deviceModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('devices/add', 'method="post" id="formDevice"') ?>
        
        <input type="hidden" name="deviceId" id="deviceId" value="">
        <div class="form-group">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <label for="hostname" class="form-label">Hostname *</label>
              <input type="text" class="form-control" id="hostname" aria-describedby="hostnameHint" placeholder="Device Hostname" required>
              <div id="hostnameHint" class="text-danger error-validation"></div>
            </div>
            <div class="col-lg-6 col-md-12">
              <label for="serialNumber" class="form-label">Serial Number *</label>
              <input type="text" class="form-control" id="serialNumber" aria-describedby="serialNumberHint" placeholder="Serial Number" required>
              <div id="serialNumberHint" class="text-danger error-validation"></div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-4 col-md-12">
              <label for="groupId" class="form-label">Device Group *</label>
              <select name="groupId" id="groupId" class="form-control" aria-describedby="groupIdHint" required>
                <option value="">Choose Device Group</option>
                <?php foreach ($groups as $group) : ?>
                
                  <option value="<?= $group['groupId'] ?>"><?= $group['groupName'] ?></option>
                <?php endforeach; ?>
              </select>
              <div id="groupIdHint" class="text-danger error-validation"></div>
            </div>
            <div class="col-lg-4 col-md-12">
              <label for="manuId" class="form-label">Manufacture *</label>
              <select name="manuId" id="manuId" class="form-control" aria-labelledby="manuIdHint" required>
                <option value="">Choose Device Manufacture</option>

                <?php foreach ($groups as $group) : ?>
                  <optgroup label="<?= $group['groupName'] ?>"></optgroup>

                  <?php 
                    foreach ($manufactures as $manu) :
                      if($manu['groupId'] === $group['groupId']) : 
                  ?>
                  <option value="<?= $manu['manuId'] ?>"><?= $manu['manuName'] ?></option>

                  <?php endif; endforeach; ?>

                <?php endforeach; ?>

              </select>
              <div id="manuIdHint" class="text-danger error-validation"></div>
              
            </div>
            <div class="col-lg-4 col-md-12">
              <label for="modelId" class="form-label">Device Model *</label>
              <select name="modelId" id="modelId" class="form-control" aria-labelledby="modelIdHint" required>
                <option value="">Choose Device Model</option>
                <?php foreach ($manufactures as $manu) : ?>
                  <optgroup label="<?= $manu['manuName'] ?>"></optgroup>

                  <?php 
                    foreach ($models as $model) :
                      if($model['manuId'] === $manu['manuId']) : 
                  ?>
                  <option value="<?= $model['modelId'] ?>"><?= $model['modelName'] ?></option>

                  <?php endif; endforeach; ?>

                <?php endforeach; ?>
              </select>
              <div id="modelIdHint" class="text-danger error-validation"></div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-6 col-md-12">
              
              <label for="processor" class="form-label">Processor</label>
              <input type="text" class="form-control" id="processor" aria-describedby="processorHint" placeholder="Processor Series">
              <div id="processorHint" class="text-danger error-validation"></div>
            </div>
            <div class="col-lg-3 col-md-6">
              <label for="cores" class="form-label">Cores</label>
              <input type="text" pattern="[0-9]+" class="form-control" id="cores" aria-describedby="coresHint" placeholder="0">
              <div id="coresHint" class="text-danger error-validation"></div>
            </div>
            <div class="col-lg-3 col-md-6">
              <label for="memoryCap" class="form-label">Memory Cap. (GB)</label>
              <input type="text" pattern="[0-9]+" class="form-control" id="memoryCap" aria-describedby="memoryCapHint" placeholder="0">
              <div id="memoryCapHint" class="text-danger error-validation"></div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-3 col-md-6">
              <label for="storageCap" class="form-label">Storage Cap. (GB)</label>
              <input type="text" pattern="[0-9.]+" class="form-control" id="storageCap" aria-describedby="storageCapHint" placeholder="0">
              <div id="storageCapHint" class="text-danger error-validation"><em>Use comma for decimal</em></div>
            </div>
            <div class="col-lg-6 col-md-12">
              
              <label for="location" class="form-label">Location *</label>
              <input type="text" class="form-control" id="location" aria-describedby="locationHint" placeholder="Processor Series">
              <div id="locationHint" class="text-danger error-validation"></div>
            </div>
            <div class="col-lg-3 col-md-6">
              <label for="rackNumber" class="form-label">Rack Number</label>
              <input type="text" pattern="[0-9]+" class="form-control" id="rackNumber" aria-describedby="rackNumberHint" placeholder="0">
              <div id="rackNumberHint" class="text-danger error-validation"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="btnSubmit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>